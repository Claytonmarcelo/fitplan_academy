<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Exibe a página de contato
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Processa o envio do formulário de contato
     */
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|min:5|max:200',
            'message' => 'required|string|min:10|max:2000',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'name.min' => 'O nome deve ter pelo menos 2 caracteres.',
            'name.max' => 'O nome deve ter no máximo 100 caracteres.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Digite um e-mail válido.',
            'email.max' => 'O e-mail deve ter no máximo 255 caracteres.',
            'phone.max' => 'O telefone deve ter no máximo 20 caracteres.',
            'subject.required' => 'O assunto é obrigatório.',
            'subject.min' => 'O assunto deve ter pelo menos 5 caracteres.',
            'subject.max' => 'O assunto deve ter no máximo 200 caracteres.',
            'message.required' => 'A mensagem é obrigatória.',
            'message.min' => 'A mensagem deve ter pelo menos 10 caracteres.',
            'message.max' => 'A mensagem deve ter no máximo 2000 caracteres.',
        ]);

        // Simular envio de e-mail (em produção, usar Mail::send)
        $contactData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'sent_at' => now(),
        ];

        // Salvar na sessão para demonstração
        session()->flash('contact_sent', $contactData);

        return redirect()->route('contact')->with('success', 'Mensagem enviada com sucesso! Entraremos em contato em breve.');
    }
}
