<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Features\User\Infrastructure\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * LoginController
 * 
 * Controller responsável pelo login real dos usuários.
 * Autentica usando login e senha cadastrados no banco de dados.
 */
class LoginController extends Controller
{
    /**
     * Exibe o formulário de login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Processa o login do usuário
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'login' => [
                'required',
                'string',
                'min:3',
                'max:20',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/^[A-Za-z]{6,}$/',
            ],
        ], [
            'login.required' => 'O login é obrigatório.',
            'login.min' => 'O login deve ter pelo menos 3 caracteres.',
            'login.max' => 'O login deve ter no máximo 20 caracteres.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.regex' => 'A senha deve conter apenas letras.',
        ]);

        // Buscar usuário pelo login
        $user = User::where('login', strtoupper($validated['login']))
                   ->where('is_active', true)
                   ->first();

        if (!$user) {
            return back()->withErrors([
                'login' => 'Login não encontrado ou usuário inativo.'
            ])->withInput();
        }

        // Verificar senha
        if (!Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Senha incorreta.'
            ])->withInput();
        }

        // Fazer login do usuário
        Auth::login($user, $request->filled('remember'));

        // Debug: verificar se o usuário está autenticado
        if (!Auth::check()) {
            return back()->withErrors([
                'login' => 'Erro na autenticação. Tente novamente.'
            ])->withInput();
        }

        // Regenerar sessão para segurança
        $request->session()->regenerate();
        
        // Redirecionar para o dashboard do aluno
        return redirect()->route('student.dashboard')
                        ->with('success', 'Bem-vindo, ' . $user->name . '!');
    }

    /**
     * Faz logout do usuário
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing')
                        ->with('success', 'Logout realizado com sucesso!');
    }
}