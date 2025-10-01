<?php

namespace App\Features\Auth\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request - Register
 * 
 * Valida os dados de registro de novo usuário.
 * 
 * @package App\Features\Auth\Presentation\Requests
 */
class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
            'name.required' => 'O nome é obrigatório',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser válido',
            'email.unique' => 'Este email já está em uso',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
            'password.confirmed' => 'As senhas não coincidem',
        ];
    }
}

