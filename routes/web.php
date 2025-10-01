<?php

use App\Features\Checkout\Presentation\Controllers\CheckoutController;
use App\Features\Plan\Presentation\Controllers\PlanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rotas web da aplicação - Landing page, checkout, login
|
*/

// Landing Page (Página de Vendas)
Route::get('/', [PlanController::class, 'landing'])->name('landing');

// Checkout (Página de Pagamento)
Route::get('/checkout/{plan}', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout/{plan}', [CheckoutController::class, 'process'])->name('checkout.process');

// Obrigado (Página de Obrigado)
Route::get('/obrigado/{plan}/{checkout}', [\App\Features\Success\Presentation\Controllers\SuccessController::class, 'show'])->name('obrigado');
Route::get('/account', [\App\Features\Success\Presentation\Controllers\SuccessController::class, 'goToAccount'])->name('account');
Route::get('/support', [\App\Features\Success\Presentation\Controllers\SuccessController::class, 'support'])->name('support');

// Login (Página de Login)
Route::get('/login', function () {
    return view('login');
})->name('login');

// Dashboard (após login) - pode ser criado depois
Route::get('/dashboard', function () {
    return view('welcome');
})->middleware('auth:sanctum')->name('dashboard');
