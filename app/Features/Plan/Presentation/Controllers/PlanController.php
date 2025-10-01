<?php

namespace App\Features\Plan\Presentation\Controllers;

use App\Features\Plan\Infrastructure\Models\Plan;
use App\Http\Controllers\Controller;

/**
 * Controller de Planos
 * 
 * Gerencia a exibição de planos e landing page
 */
class PlanController extends Controller
{
    /**
     * Exibe a landing page com os planos
     */
    public function landing()
    {
        $plans = Plan::active()->get();
        
        return view('landing', compact('plans'));
    }

    /**
     * Lista todos os planos (API)
     */
    public function index()
    {
        $plans = Plan::active()->get();
        
        return response()->json([
            'data' => $plans
        ]);
    }
}

