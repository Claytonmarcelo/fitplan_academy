<?php

use App\Features\Checkout\Presentation\Controllers\CheckoutController;
use App\Features\Plan\Presentation\Controllers\PlanController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\Auth\DemoAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\UnitController;
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

// Página de contato
Route::get('/contato', [ContactController::class, 'index'])->name('contact');
Route::post('/contato', [ContactController::class, 'send'])->name('contact.send');

// Checkout (Página de Pagamento)
Route::get('/checkout/{plan}', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout/{plan}', [CheckoutController::class, 'process'])->name('checkout.process');

// Obrigado (Página de Obrigado)
Route::get('/obrigado/{plan}/{checkout}', [\App\Features\Success\Presentation\Controllers\SuccessController::class, 'show'])->name('obrigado');
Route::get('/account', [\App\Features\Success\Presentation\Controllers\SuccessController::class, 'goToAccount'])->name('account');
Route::get('/support', [\App\Features\Success\Presentation\Controllers\SuccessController::class, 'support'])->name('support');

// Autenticação Demo (Funciona sem banco de dados)
Route::get('/login', [DemoAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [DemoAuthController::class, 'login'])->name('demo.login');
Route::get('/logout', [DemoAuthController::class, 'logout'])->name('logout');

// Autenticação Original (com banco de dados)
Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('auth.login.page');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

// 2FA
Route::get('/2fa', [AuthController::class, 'show2fa'])->name('2fa.verify');
Route::post('/2fa', [AuthController::class, 'verify2fa'])->name('2fa.verify');

// Registro
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');

// Cadastro sem compromisso (sem plano pré-selecionado)
Route::get('/cadastro', [RegisterController::class, 'showRegister'])->name('cadastro')->defaults('sem_plano', true);

// API para busca de CEP (AJAX)
Route::post('/api/search-cep', [RegisterController::class, 'searchCep'])->name('api.search-cep');


// Rotas protegidas por autenticação demo (sem banco de dados)
Route::middleware('demo.auth')->group(function () {
    
    // Dashboard Principal (Master e Comum)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Dashboard do Aluno (usuários Comum)
    Route::get('/dashboard-aluno', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    
    
    // Gerenciamento de Usuários
    Route::resource('users', UserManagementController::class);
    
    // Logs de Acesso (apenas Master)
    Route::get('/access-logs', [UserManagementController::class, 'accessLogs'])->name('access-logs');
    
    // Exportar PDF de Usuários (apenas Master)
    Route::get('/users-pdf', [UserManagementController::class, 'exportPdf'])->name('users.pdf');
    
    // API para busca de CEP no gerenciamento
    Route::post('/api/user-search-cep', [UserManagementController::class, 'searchCep'])->name('api.user-search-cep');
    
    // Alteração de Senha
    Route::get('/change-password', [UserManagementController::class, 'showChangePassword'])->name('change-password');
    Route::post('/change-password', [UserManagementController::class, 'changePassword'])->name('change-password.update');
    
    // API do Dashboard do Aluno
    Route::prefix('api/student')->group(function () {
        Route::post('/workout/complete', [StudentDashboardController::class, 'markWorkoutCompleted'])->name('student.workout.complete');
        Route::post('/workout/start', [StudentDashboardController::class, 'startWorkout'])->name('student.workout.start');
        Route::get('/workouts', [StudentDashboardController::class, 'getUserWorkouts'])->name('student.workouts');
    });
    
    // Rotas de Treinos
    Route::prefix('workouts')->group(function () {
        Route::get('/', [WorkoutController::class, 'index'])->name('workouts.index');
        Route::get('/{workoutId}', [WorkoutController::class, 'show'])->name('workouts.show');
        Route::post('/{workoutId}/start', [WorkoutController::class, 'start'])->name('workouts.start');
        Route::post('/{workoutId}/complete', [WorkoutController::class, 'complete'])->name('workouts.complete');
    });
    
    // Rotas de Aulas
    Route::prefix('classes')->group(function () {
        Route::get('/', [ClassController::class, 'index'])->name('classes.index');
        Route::get('/{classId}', [ClassController::class, 'show'])->name('classes.show');
        Route::post('/{classId}/enroll', [ClassController::class, 'enroll'])->name('classes.enroll');
        Route::post('/{classId}/cancel', [ClassController::class, 'cancel'])->name('classes.cancel');
    });
    
    // Rotas de Desafios
    Route::prefix('challenges')->group(function () {
        Route::get('/', [ChallengeController::class, 'index'])->name('challenges.index');
        Route::get('/{challengeId}', [ChallengeController::class, 'show'])->name('challenges.show');
        Route::post('/{challengeId}/join', [ChallengeController::class, 'join'])->name('challenges.join');
        Route::post('/update-progress', [ChallengeController::class, 'updateProgress'])->name('challenges.update-progress');
    });
    
    // Rotas de Comunidade
    Route::prefix('community')->group(function () {
        Route::get('/', [CommunityController::class, 'index'])->name('community.index');
        Route::get('/posts/{postId}', [CommunityController::class, 'showPost'])->name('community.post');
        Route::post('/create-post', [CommunityController::class, 'createPost'])->name('community.create-post');
        Route::post('/posts/{postId}/like', [CommunityController::class, 'likePost'])->name('community.like-post');
        Route::post('/posts/{postId}/comment', [CommunityController::class, 'addComment'])->name('community.add-comment');
    });
    
});
