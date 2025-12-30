<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Features\User\Infrastructure\Models\User;
use App\Models\AccessLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PragmaRX\Google2FA\Google2FA;

/**
 * AuthController
 * 
 * Controller responsável pela autenticação do sistema,
 * incluindo login, logout e verificação 2FA.
 */
class AuthController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    /**
     * Exibe a tela de login
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

        $user = User::where('login', $request->login)
                   ->where('is_active', true)
                   ->first();

        $loginSuccessful = false;

        if ($user && Hash::check($request->password, $user->password)) {
            $loginSuccessful = true;
            
            // Se o usuário tem 2FA configurado, redireciona para verificação
            if ($user->hasTwoFactorEnabled()) {
                Session::put('2fa_user_id', $user->id);
                Session::put('2fa_login_time', now());
                
                // Log do acesso (ainda não autenticado completamente)
                $this->logAccess($user, $request, false, false);
                
                return redirect()->route('2fa.verify')
                               ->with('message', 'Digite o código do seu aplicativo autenticador.');
            }
            
            // Login sem 2FA
            Auth::login($user);
            $request->session()->regenerate();
            
            // Log do acesso bem-sucedido
            $this->logAccess($user, $request, $loginSuccessful, false);
            
            // Redireciona baseado no role do usuário
            $dashboardRoute = $user->role === 'master' || $user->role === 'admin' 
                ? route('admin.dashboard') 
                : route('student.dashboard');
            
            return redirect()->intended($dashboardRoute)
                           ->with('success', 'Login realizado com sucesso!');
        }

        // Log de tentativa de acesso mal-sucedida
        if ($user) {
            $this->logAccess($user, $request, false, false);
        }

        return back()->withErrors([
            'login' => 'As credenciais fornecidas não conferem.',
        ])->onlyInput('login');
    }

    /**
     * Exibe a tela de verificação 2FA
     */
    public function show2fa()
    {
        if (!Session::has('2fa_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.2fa');
    }

    /**
     * Verifica o código 2FA
     */
    public function verify2fa(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ], [
            'code.required' => 'O código 2FA é obrigatório.',
            'code.size' => 'O código deve ter exatamente 6 dígitos.',
        ]);

        if (!Session::has('2fa_user_id')) {
            return redirect()->route('login')
                           ->withErrors(['code' => 'Sessão expirada. Faça login novamente.']);
        }

        $user = User::find(Session::get('2fa_user_id'));
        
        if (!$user) {
            Session::forget(['2fa_user_id', '2fa_login_time']);
            return redirect()->route('login')
                           ->withErrors(['code' => 'Usuário não encontrado.']);
        }

        $valid = $this->google2fa->verifyKey($user->two_factor_secret, $request->code);

        if ($valid) {
            Auth::login($user);
            $request->session()->regenerate();
            
            // Remove dados temporários da sessão
            Session::forget(['2fa_user_id', '2fa_login_time']);
            
            // Log do acesso bem-sucedido com 2FA
            $this->logAccess($user, $request, true, true);
            
            // Redireciona baseado no role do usuário
            $dashboardRoute = $user->role === 'master' || $user->role === 'admin' 
                ? route('admin.dashboard') 
                : route('student.dashboard');
            
            return redirect()->intended($dashboardRoute)
                           ->with('success', 'Login realizado com sucesso!');
        }

        // Log de tentativa de 2FA mal-sucedida
        $this->logAccess($user, $request, false, true);

        return back()->withErrors([
            'code' => 'Código 2FA inválido.',
        ]);
    }

    /**
     * Faz logout do usuário
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
                       ->with('success', 'Logout realizado com sucesso!');
    }

    /**
     * Registra log de acesso
     */
    private function logAccess(User $user, Request $request, bool $successful, bool $twoFactorUsed)
    {
        AccessLog::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_cpf' => $user->cpf,
            'user_login' => $user->login,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'two_factor_used' => $twoFactorUsed,
            'login_successful' => $successful,
        ]);
    }
}
