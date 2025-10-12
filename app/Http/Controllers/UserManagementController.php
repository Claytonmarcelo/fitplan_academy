<?php

namespace App\Http\Controllers;

use App\Features\User\Infrastructure\Models\User;
use App\Models\AccessLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * UserManagementController
 * 
 * Controller para gerenciar usuários do sistema.
 * Inclui funcionalidades de listagem, consulta, edição e exclusão.
 */
class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lista todos os usuários com paginação e busca
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Busca por nome
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('cpf', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('login', 'LIKE', "%{$search}%");
        }

        // Filtro por perfil
        if ($request->filled('profile')) {
            $query->where('profile', $request->profile);
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('users.index', compact('users'));
    }

    /**
     * Exibe detalhes de um usuário específico
     */
    public function show(User $user)
    {
        $accessLogs = $user->accessLogs()
                          ->orderBy('created_at', 'desc')
                          ->limit(20)
                          ->get();

        return view('users.show', compact('user', 'accessLogs'));
    }

    /**
     * Exibe formulário de edição de usuário
     */
    public function edit(User $user)
    {
        // Verifica se o usuário pode editar (Master pode editar todos, Comum só a si mesmo)
        if (!Auth::user()->isMaster() && Auth::id() !== $user->id) {
            abort(403, 'Você não tem permissão para editar este usuário.');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Atualiza dados do usuário
     */
    public function update(Request $request, User $user)
    {
        // Verifica se o usuário pode editar
        if (!Auth::user()->isMaster() && Auth::id() !== $user->id) {
            abort(403, 'Você não tem permissão para editar este usuário.');
        }

        $rules = [
            'name' => 'required|string|min:8|max:60|regex:/^[a-zA-ZÀ-ÿ\s]+$/',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|regex:/^\(\d{2}\) \d{4,5}-\d{4}$/',
            'cep' => 'required|string|regex:/^\d{5}-\d{3}$/',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'complement' => 'nullable|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|size:2',
        ];

        // Só Master pode alterar perfil e status
        if (Auth::user()->isMaster()) {
            $rules['profile'] = 'required|in:master,comum';
            $rules['is_active'] = 'required|boolean';
        }

        $validated = $request->validate($rules);

        // Remove campos que usuário comum não pode alterar
        if (!Auth::user()->isMaster()) {
            unset($validated['profile'], $validated['is_active']);
        }

        $user->update($validated);

        return redirect()->route('users.show', $user)
                        ->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove usuário do sistema (apenas Master)
     */
    public function destroy(User $user)
    {
        if (!Auth::user()->isMaster()) {
            abort(403, 'Apenas usuários Master podem excluir usuários.');
        }

        // Não permite excluir o próprio usuário
        if (Auth::id() === $user->id) {
            return redirect()->back()
                           ->with('error', 'Você não pode excluir sua própria conta.');
        }

        // Não permite excluir outro Master
        if ($user->isMaster()) {
            return redirect()->back()
                           ->with('error', 'Não é possível excluir usuários Master.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('users.index')
                        ->with('success', "Usuário {$userName} foi excluído com sucesso.");
    }

    /**
     * Exporta lista de usuários em PDF
     */
    public function exportPdf(Request $request)
    {
        if (!Auth::user()->isMaster()) {
            abort(403, 'Apenas usuários Master podem exportar relatórios.');
        }

        $query = User::query();

        // Aplica mesmos filtros da listagem
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('cpf', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
        }

        if ($request->filled('profile')) {
            $query->where('profile', $request->profile);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $users = $query->orderBy('name')->get();

        $pdf = Pdf::loadView('users.pdf', compact('users'));
        
        return $pdf->download('usuarios-fitplan-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Busca endereço por CEP (API ViaCEP)
     */
    public function searchCep(Request $request)
    {
        $request->validate([
            'cep' => 'required|regex:/^\d{5}-?\d{3}$/'
        ]);

        $cep = preg_replace('/[^0-9]/', '', $request->cep);

        try {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
            $data = $response->json();

            if (isset($data['erro'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'CEP não encontrado.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'street' => $data['logradouro'],
                    'district' => $data['bairro'],
                    'city' => $data['localidade'],
                    'state' => $data['uf']
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao consultar CEP. Tente novamente.'
            ], 500);
        }
    }

    /**
     * Exibe logs de acesso (apenas Master)
     */
    public function accessLogs(Request $request)
    {
        if (!Auth::user()->isMaster()) {
            abort(403, 'Apenas usuários Master podem visualizar logs de acesso.');
        }

        $query = AccessLog::with('user');

        // Filtros
        if ($request->filled('user_name')) {
            $query->where('user_name', 'LIKE', '%' . $request->user_name . '%');
        }

        if ($request->filled('user_cpf')) {
            $query->where('user_cpf', 'LIKE', '%' . $request->user_cpf . '%');
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('successful')) {
            $query->where('login_successful', $request->successful === '1');
        }

        if ($request->filled('two_factor')) {
            $query->where('two_factor_used', $request->two_factor === '1');
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(25);

        return view('users.access-logs', compact('logs'));
    }

    /**
     * Exibe formulário para alterar senha
     */
    public function showChangePassword()
    {
        return view('users.change-password');
    }

    /**
     * Processa alteração de senha
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|regex:/^[A-Za-z]{8,}$/',
            'password_confirmation' => 'required|min:8|regex:/^[A-Za-z]{8,}$/',
        ], [
            'current_password.required' => 'A senha atual é obrigatória.',
            'password.required' => 'A nova senha é obrigatória.',
            'password.min' => 'A nova senha deve ter pelo menos 8 caracteres.',
            'password.regex' => 'A nova senha deve conter apenas caracteres alfabéticos.',
            'password.confirmed' => 'A confirmação da nova senha não confere.',
            'password_confirmation.regex' => 'A confirmação da senha deve conter apenas caracteres alfabéticos.',
        ]);

        $user = Auth::user();

        // Verifica senha atual
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'A senha atual está incorreta.'
            ]);
        }

        // Atualiza senha
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('dashboard')
                        ->with('success', 'Senha alterada com sucesso!');
    }
}
