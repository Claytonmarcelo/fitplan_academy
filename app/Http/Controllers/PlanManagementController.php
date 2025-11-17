<?php

namespace App\Http\Controllers;

use App\Features\Plan\Infrastructure\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * PlanManagementController
 * 
 * Controller para gerenciar planos do sistema.
 * Permite visualizar, editar preços e ativar/desativar planos.
 */
class PlanManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lista todos os planos
     */
    public function index()
    {
        if (!Auth::user()->isMaster()) {
            abort(403, 'Apenas administradores podem gerenciar planos.');
        }

        $plans = Plan::orderBy('price', 'asc')->get();

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Exibe formulário de edição de plano
     */
    public function edit(Plan $plan)
    {
        if (!Auth::user()->isMaster()) {
            abort(403, 'Apenas administradores podem editar planos.');
        }

        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Atualiza dados do plano
     */
    public function update(Request $request, Plan $plan)
    {
        if (!Auth::user()->isMaster()) {
            abort(403, 'Apenas administradores podem editar planos.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'O nome do plano é obrigatório.',
            'description.required' => 'A descrição do plano é obrigatória.',
            'price.required' => 'O preço do plano é obrigatório.',
            'price.numeric' => 'O preço deve ser um número.',
            'price.min' => 'O preço não pode ser negativo.',
            'is_active.required' => 'O status do plano é obrigatório.',
        ]);

        $plan->update($validated);

        return redirect()->route('admin.plans.index')
                        ->with('success', 'Plano atualizado com sucesso!');
    }
}

