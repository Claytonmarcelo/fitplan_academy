<?php

namespace App\Features\Auth\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request - Login
 * 
 * Valida os dados de login.
 * 
 * @package App\Features\Auth\Presentation\Requests
 */
class LoginRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação
     * 
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * Mensagens de erro customizadas
     * 
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser válido',
            'password.required' => 'A senha é obrigatória',
        ];
    }
}

