<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Features\User\Infrastructure\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

/**
 * RegisterController
 * 
 * Controller responsável pelo registro de novos usuários.
 * Inclui validações brasileiras completas (CPF, CEP, telefone).
 */
class RegisterController extends Controller
{
    /**
     * Exibe o formulário de registro
     */
    public function showRegister()
    {
        $semPlano = request()->route()->parameter('sem_plano', false);
        return view('auth.register', compact('semPlano'));
    }

    /**
     * Processa o registro do usuário
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            // Dados pessoais
            'name' => [
                'required',
                'string',
                'min:8',
                'max:60',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/'
            ],
            'cpf' => [
                'required',
                'string',
                'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
                function ($attribute, $value, $fail) {
                    if (!$this->validateCpf($value)) {
                        $fail('O CPF informado é inválido.');
                    }
                },
            ],
            'email' => 'required|email',
            'phone' => [
                'required',
                'string',
                'regex:/^\(\d{2}\) \d{4,5}-\d{4}$/'
            ],
            
            // Endereço
            'cep' => [
                'required',
                'string',
                'regex:/^\d{5}-\d{3}$/'
            ],
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'complement' => 'nullable|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|size:2',
            
            // Credenciais
            'login' => [
                'required',
                'string',
                'size:6',
                'regex:/^[A-Za-z]{6}$/',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
            'password_confirmation' => 'required|string|min:8',
            
        ], [
            // Mensagens personalizadas
            'name.required' => 'O nome é obrigatório.',
            'name.min' => 'O nome deve ter pelo menos 8 caracteres.',
            'name.max' => 'O nome deve ter no máximo 60 caracteres.',
            'name.regex' => 'O nome deve conter apenas letras.',
            
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.regex' => 'O CPF deve estar no formato 000.000.000-00.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ter um formato válido.',
            'email.unique' => 'Este email já está cadastrado.',
            
            'phone.required' => 'O telefone é obrigatório.',
            'phone.regex' => 'O telefone deve estar no formato (XX) XXXXX-XXXX.',
            
            'cep.required' => 'O CEP é obrigatório.',
            'cep.regex' => 'O CEP deve estar no formato 00000-000.',
            
            'street.required' => 'A rua é obrigatória.',
            'number.required' => 'O número é obrigatório.',
            'district.required' => 'O bairro é obrigatório.',
            'city.required' => 'A cidade é obrigatória.',
            'state.required' => 'O estado é obrigatório.',
            'state.size' => 'O estado deve ter 2 caracteres.',
            
            'login.required' => 'O login é obrigatório.',
            'login.size' => 'O login deve ter exatamente 6 caracteres.',
            'login.regex' => 'O login deve conter apenas letras.',
            'login.unique' => 'Este login já está em uso.',
            
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ]);

        // Validar CEP com API
        if (!$this->validateCepWithApi($validated['cep'])) {
            return back()->withErrors([
                'cep' => 'CEP não encontrado ou inválido.'
            ])->withInput();
        }

        // Simular criação do usuário (sem banco de dados para demo)
        $userData = [
            'id' => rand(1000, 9999), // ID simulado
            'name' => $validated['name'],
            'cpf' => $validated['cpf'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'cep' => $validated['cep'],
            'street' => $validated['street'],
            'number' => $validated['number'],
            'complement' => $validated['complement'],
            'district' => $validated['district'],
            'city' => $validated['city'],
            'state' => strtoupper($validated['state']),
            'login' => strtoupper($validated['login']),
            'profile' => 'comum',
            'is_active' => true,
            'created_at' => now(),
        ];

        // Armazenar dados temporariamente na sessão para demonstração
        session()->flash('registered_user', $userData);

        return redirect()->route('login')
                        ->with('success', 'Cadastro realizado com sucesso! Use o login: ' . strtoupper($validated['login']) . ' para entrar no sistema.');
    }

    /**
     * Valida CPF usando algoritmo de dígito verificador
     */
    private function validateCpf(string $cpf): bool
    {
        // Remove formatação
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        // Verifica se tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }
        
        // Verifica se todos os dígitos são iguais
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        
        // Calcula o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += $cpf[$i] * (10 - $i);
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;
        
        // Verifica o primeiro dígito
        if ($cpf[9] != $digito1) {
            return false;
        }
        
        // Calcula o segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += $cpf[$i] * (11 - $i);
        }
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;
        
        // Verifica o segundo dígito
        return $cpf[10] == $digito2;
    }

    /**
     * Valida CEP com API ViaCEP
     */
    private function validateCepWithApi(string $cep): bool
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);
        
        try {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
            $data = $response->json();
            
            return !isset($data['erro']);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Busca endereço por CEP via AJAX
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
}
