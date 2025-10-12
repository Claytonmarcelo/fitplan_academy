<?php

use App\Features\Checkout\Presentation\Controllers\CheckoutController;
use App\Features\Plan\Presentation\Controllers\PlanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\Auth\DemoAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LegalController;
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

// Checkout (Página de Pagamento)
Route::get('/checkout/{plan}', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout/{plan}', [CheckoutController::class, 'process'])->name('checkout.process');

// Obrigado (Página de Obrigado)
Route::get('/obrigado/{plan}/{checkout}', [\App\Features\Success\Presentation\Controllers\SuccessController::class, 'show'])->name('obrigado');
Route::get('/account', [\App\Features\Success\Presentation\Controllers\SuccessController::class, 'goToAccount'])->name('account');
Route::get('/support', [\App\Features\Success\Presentation\Controllers\SuccessController::class, 'support'])->name('support');

// Autenticação Real (com banco de dados)
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Autenticação Demo (Funciona sem banco de dados) - MANTIDA PARA COMPATIBILIDADE
Route::get('/demo/login', [DemoAuthController::class, 'showLogin'])->name('demo.login');
Route::post('/demo/login', [DemoAuthController::class, 'login'])->name('demo.login.post');
Route::get('/demo/logout', [DemoAuthController::class, 'logout'])->name('demo.logout');

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


// Rotas protegidas por autenticação real (com banco de dados)
Route::middleware('auth')->group(function () {
    
    // Dashboard Principal (Master e Comum)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Dashboard do Aluno (usuários Comum)
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    
    // Rotas de Treinos
    Route::prefix('workouts')->group(function () {
        Route::get('/', [WorkoutController::class, 'index'])->name('workouts.index');
        Route::get('/{workoutId}', [WorkoutController::class, 'show'])->name('workouts.show');
        Route::get('/{workoutId}/execute', [WorkoutController::class, 'execute'])->name('workouts.execute');
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
        Route::post('/{challengeId}/update-progress', [ChallengeController::class, 'updateProgress'])->name('challenges.update-progress');
    });
    
    // Rotas de Comunidade
    Route::prefix('community')->group(function () {
        Route::get('/', [CommunityController::class, 'index'])->name('community.index');
        Route::get('/posts/{postId}', [CommunityController::class, 'showPost'])->name('community.show-post');
        Route::post('/posts', [CommunityController::class, 'createPost'])->name('community.create-post');
        Route::post('/posts/{postId}/like', [CommunityController::class, 'likePost'])->name('community.like-post');
        Route::post('/posts/{postId}/comment', [CommunityController::class, 'addComment'])->name('community.add-comment');
    });
    
    // Gerenciamento de Usuários (apenas Master)
    Route::middleware('role:master')->group(function () {
        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserManagementController::class, 'show'])->name('users.show');
        Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/{user}/logs', [UserManagementController::class, 'logs'])->name('users.logs');
    });
});

// Rotas protegidas por autenticação demo (sem banco de dados) - MANTIDAS PARA COMPATIBILIDADE
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
                Route::get('/{workoutId}/execute', [WorkoutController::class, 'execute'])->name('workouts.execute');
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
