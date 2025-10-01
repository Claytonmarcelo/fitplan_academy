<?php

namespace App\Features\User\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request - Update User
 * 
 * Valida os dados de entrada para atualização de usuário.
 * Campos são opcionais (atualização parcial).
 * 
 * @package App\Features\User\Presentation\Requests
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        // TODO: Implementar lógica de autorização
        // Verificar se o usuário pode editar este perfil
        return true;
    }

    /**
     * Regras de validação
     * 
     * Validações aplicadas:
     * - name: opcional, string, 3-255 caracteres
     * - email: opcional, email válido, único (exceto para o próprio usuário)
     * - password: opcional, mínimo 8 caracteres, deve ser confirmado
     * - is_active: opcional, booleano
     * 
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $userId = $this->route('id');

        return [
            'name' => ['sometimes', 'string', 'min:3', 'max:255'],
            'email' => [
                'sometimes',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId)
            ],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
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
            'name.min' => 'O nome deve ter no mínimo 3 caracteres',
            'email.email' => 'O email deve ser válido',
            'email.unique' => 'Este email já está em uso',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
            'password.confirmed' => 'As senhas não coincidem',
        ];
    }
}

