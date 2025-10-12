<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Exibe a página de Política de Privacidade
     */
    public function privacyPolicy()
    {
        return view('legal.privacy-policy');
    }

    /**
     * Exibe a página de Termos de Serviço
     */
    public function termsOfService()
    {
        return view('legal.terms-of-service');
    }

    /**
     * Exibe a página de FAQ (Perguntas Frequentes)
     */
    public function faq()
    {
        return view('legal.faq');
    }
}
