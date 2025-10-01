<?php

namespace App\Features\User\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request - Create User
 * 
 * Valida os dados de entrada para criação de usuário.
 * Laravel executa esta validação antes de chegar no controller.
 * 
 * Performance: Validação rápida antes de processar lógica de negócio.
 * 
 * @package App\Features\User\Presentation\Requests
 */
class CreateUserRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        // TODO: Implementar lógica de autorização
        // Por enquanto, permitimos todas as requisições
        return true;
    }

    /**
     * Regras de validação
     * 
     * Validações aplicadas:
     * - name: obrigatório, string, 3-255 caracteres
     * - email: obrigatório, email válido, único na tabela users
     * - password: obrigatório, mínimo 8 caracteres, deve ser confirmado
     * - is_active: opcional, booleano
     * 
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_active' => ['sometimes', 'boolean'],
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

