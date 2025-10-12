<?php

use App\Features\Checkout\Presentation\Controllers\CheckoutController;
use App\Features\Plan\Presentation\Controllers\PlanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\Auth\DemoAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ComparisonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rotas web da aplicação - Landing page, checkout, autenticação e dashboard
|
*/

// Landing Page (Página de Vendas)
Route::get('/', [PlanController::class, 'landing'])->name('landing');

// Páginas individuais dos planos
Route::get('/planos/basic', [PlanController::class, 'show'])->defaults('plan_name', 'Basic')->name('plan.basic');
Route::get('/planos/smart', [PlanController::class, 'show'])->defaults('plan_name', 'Smart')->name('plan.smart');
Route::get('/planos/black', [PlanController::class, 'show'])->defaults('plan_name', 'Black')->name('plan.black');

// Rotas para unidades
Route::get('/unidades', [UnitController::class, 'index'])->name('units.index');
Route::get('/unidades/{unitId}', [UnitController::class, 'show'])->name('unit.show');

// Rotas de Comparação
Route::get('/comparacao', [ComparisonController::class, 'index'])->name('comparison.index');
Route::get('/comparacao/precos', [ComparisonController::class, 'prices'])->name('comparison.prices');
Route::get('/comparacao/beneficios', [ComparisonController::class, 'benefits'])->name('comparison.benefits');

// Páginas Legais
Route::get('/politica-privacidade', [LegalController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/termos-servico', [LegalController::class, 'termsOfService'])->name('terms.service');
Route::get('/faq', [LegalController::class, 'faq'])->name('faq');

// Contato
Route::get('/contato', [ContactController::class, 'index'])->name('contact');
Route::post('/contato', [ContactController::class, 'send'])->name('contact.send');

// Checkout
Route::get('/checkout/{planId}', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout/{planId}', [CheckoutController::class, 'process'])->name('checkout.process');

// Autenticação Demo (sem banco de dados)
Route::get('/demo/login', [DemoAuthController::class, 'showLogin'])->name('demo.login');
Route::post('/demo/login', [DemoAuthController::class, 'login'])->name('demo.login.post');
Route::get('/demo/logout', [DemoAuthController::class, 'logout'])->name('demo.logout');

// 2FA
Route::get('/2fa', [LoginController::class, 'show2fa'])->name('2fa.verify');
Route::post('/2fa', [LoginController::class, 'verify2fa'])->name('2fa.verify');

// Registro
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');

// Login/Logout
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Cadastro sem compromisso (sem plano pré-selecionado)
Route::get('/cadastro', [RegisterController::class, 'showRegister'])->name('cadastro')->defaults('sem_plano', true);
Route::post('/cadastro', [RegisterController::class, 'register'])->name('cadastro.store');

// API para busca de CEP (AJAX)
Route::post('/api/search-cep', [RegisterController::class, 'searchCep'])->name('api.search-cep');

// Teste de autenticação
Route::get('/test-auth', function() {
    if (Auth::check()) {
        return response()->json([
            'authenticated' => true,
            'user' => Auth::user()->name,
            'role' => Auth::user()->role,
            'isMaster' => Auth::user()->isMaster()
        ]);
    } else {
        return response()->json(['authenticated' => false]);
    }
})->name('test.auth');

// Rotas protegidas por autenticação real (com banco de dados)
Route::middleware('auth')->group(function () {
    
    // Dashboard do Aluno (usuários Comum)
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
});

// Rotas protegidas por autenticação demo (sem banco de dados) - MANTIDAS PARA COMPATIBILIDADE
Route::middleware('demo.auth')->group(function () {
    
    // Dashboard do Aluno (usuários Comum) - Rota alternativa para compatibilidade
    Route::get('/dashboard-aluno', [StudentDashboardController::class, 'index'])->name('student.dashboard.demo');
    
    // API do Dashboard do Aluno
    Route::prefix('api/student')->group(function () {
        Route::post('/workout/complete', [StudentDashboardController::class, 'markWorkoutCompleted'])->name('student.workout.complete');
        Route::post('/workout/start', [StudentDashboardController::class, 'startWorkout'])->name('student.workout.start');
        Route::get('/workouts', [StudentDashboardController::class, 'getUserWorkouts'])->name('student.workouts');
    });
});