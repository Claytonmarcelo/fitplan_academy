<?php

use App\Features\Auth\Presentation\Controllers\AuthController;
use App\Features\User\Presentation\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Rotas da API REST usando Laravel Sanctum para autenticação.
| Todas as rotas retornam JSON e seguem padrões RESTful.
|
| Padrões de URL:
| - POST   /resource        - Criar
| - GET    /resource        - Listar (paginado)
| - GET    /resource/{id}   - Buscar um
| - PUT    /resource/{id}   - Atualizar
| - DELETE /resource/{id}   - Deletar
|
*/

// Grupo de rotas de autenticação (públicas)
Route::prefix('auth')->group(function () {
    // Registro de novo usuário
    Route::post('/register', [AuthController::class, 'register'])
        ->name('auth.register');
    
    // Login (gera token)
    Route::post('/login', [AuthController::class, 'login'])
        ->name('auth.login');
    
    // Rotas protegidas por autenticação
    Route::middleware('auth:sanctum')->group(function () {
        // Logout (revoga token)
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('auth.logout');
        
        // Dados do usuário autenticado
        Route::get('/me', [AuthController::class, 'me'])
            ->name('auth.me');
    });
});

// Grupo de rotas de usuários (protegidas por autenticação)
Route::middleware('auth:sanctum')->group(function () {
    // CRUD completo de usuários
    Route::apiResource('users', UserController::class);
});

// Rota de health check (pública)
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toIso8601String(),
        'service' => 'FitPlan Academy API',
    ]);
})->name('health');

