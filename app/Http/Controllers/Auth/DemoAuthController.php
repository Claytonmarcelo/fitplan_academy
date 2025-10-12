<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * Controller de Demonstração para Testes Sem Banco
 * Funciona sem MySQL/SQLite usando dados simulados
 */
class DemoAuthController extends \App\Http\Controllers\Auth\AuthController
{
    /**
     * Data de usuários simulados para demo
     */
    private $demoUsers = [
        'MASTER' => [
            'id' => 1,
            'name' => 'Administrador Master',
            'login' => 'MASTER',
            'password' => '$2y$10$92VIlKDHYy1T3pLvXpXUjOWu8jQaGHxMOP7OOGqj4yHvjqKdR2K0K', // "Master123"
            'email' => 'master@fitplan.com.br',
            'cpf' => '000.000.000-00',
            'profile' => 'master',
            'is_active' => 'true',
            'two_factor_secret' => null,
            'two_factor_confirmed_at' => null,
        ],
        'SOPHIA' => [
            'id' => 2,
            'name' => 'Sofia Maria Silva',
            'login' => 'SOPHIA',
            'password' => '$2y$10$92VIlKDHYy1T3pLvXpXUjOWu8jQaGHxMOP7OOGqj4yHvjqKdR2K0K', // "Student123"
            'email' => 'sofia@fitplan.com.br',
            'cpf' => '123.456.789-00',
            'profile' => 'comum',
            'is_active' => true,
            'two_factor_confirmed_at' => null,
        ],
    ];

    /**
     * Processa o login usando dados simulados
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string|size:6',
            'password' => 'required|string|min:8|regex:/^[A-Za-z]{8,}$/',
        ], [
            'login.required' => 'O campo login é obrigatório.',
            'login.size' => 'O login deve ter exatamente 6 caracteres.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.regex' => 'A senha deve conter apenas caracteres alfabéticos.',
        ]);

        $login = strtoupper($request->login);
        
        // Verificar se existe usuário demo
        if (!isset($this->demoUsers[$login])) {
            return back()->withErrors([
                'login' => 'Usuário não encontrado. Use: MASTER (admin) ou SOPHIA (aluno)'
            ])->withInput($request->only('login'));
        }

        $user = $this->demoUsers[$login];
        
        // Verificar senha
        $validPasswords = [
            'MASTER' => 'Master123',
            'SOPHIA' => 'Student@123'
        ];
        
        if ($request->password !== $validPasswords[$login]) {
            return back()->withErrors([
                'password' => 'Senha incorreta.',
            ])->withInput($request->only('login'));
        }

        // Simular sessão de usuário (sem requerer banco)
        Session::put('demo_user', $user);
        Session::put('user_id', $user['id']);
        Session::put('authenticated', true);
        Session::put('demo_login_time', now());

        // Redirecionar baseado no perfil do usuário
        if ($user['profile'] === 'master') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }

    /**
     * Mostrar tela de login com informações de demo
     */
    public function showLogin()
    {
        return view('auth.login-demo');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Session::flush();
        
        return redirect()->route('login')->with('success', 'Logout realizado com sucesso!');
    }
}
