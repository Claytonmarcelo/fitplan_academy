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
                'size:6',
                'regex:/^[A-Za-z]{6}$/',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^[A-Za-z]{8,}$/',
            ],
        ], [
            'login.required' => 'O login é obrigatório.',
            'login.size' => 'O login deve ter exatamente 6 caracteres.',
            'login.regex' => 'O login deve conter apenas letras.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.regex' => 'A senha deve conter apenas caracteres alfabéticos.',
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

        // Redirecionar baseado no perfil
        if ($user->isMaster()) {
            return redirect()->route('dashboard')
                            ->with('success', 'Bem-vindo, ' . $user->name . '!');
        } else {
            return redirect()->route('student.dashboard')
                            ->with('success', 'Bem-vindo, ' . $user->name . '!');
        }
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