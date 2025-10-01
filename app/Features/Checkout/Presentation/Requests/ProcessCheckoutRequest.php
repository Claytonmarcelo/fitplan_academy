<?php

namespace App\Features\Checkout\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request para processamento de checkout
 * 
 * Valida os dados de entrada do checkout
 */
class ProcessCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^\(\d{2}\)\s\d{4,5}-\d{4}$/'],
            'cpf' => ['required', 'string', 'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/'],
            'payment_method' => ['required', 'string', 'in:credit_card,pix,boleto'],
            'zip_code' => ['required', 'string', 'regex:/^\d{5}-?\d{3}$/'],
            'street' => ['required', 'string', 'max:255'],
            'neighborhood' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:2'],
            'number' => ['required', 'string', 'max:10'],
            'complement' => ['nullable', 'string', 'max:255'],
        ];

        // Adicionar validações do cartão apenas se cartão for selecionado
        if ($this->input('payment_method') === 'credit_card') {
            $rules['card_name'] = ['required', 'string', 'max:255'];
            $rules['card_number'] = ['required', 'string', 'regex:/^\d{4}\s?\d{4}\s?\d{4}\s?\d{4}$/'];
            $rules['expiry_date'] = ['required', 'string', 'regex:/^\d{2}\/\d{2}$/'];
            $rules['cvc'] = ['required', 'string', 'regex:/^\d{3,4}$/'];
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'O nome é obrigatório.',
            'first_name.max' => 'O nome não pode ter mais de 255 caracteres.',
            
            'last_name.required' => 'O sobrenome é obrigatório.',
            'last_name.max' => 'O sobrenome não pode ter mais de 255 caracteres.',
            
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ter um formato válido.',
            'email.max' => 'O email não pode ter mais de 255 caracteres.',
            
            'phone.required' => 'O telefone é obrigatório.',
            'phone.regex' => 'O telefone deve estar no formato (11) 99999-9999.',
            
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.regex' => 'O CPF deve estar no formato 000.000.000-00.',
            
            'payment_method.required' => 'O método de pagamento é obrigatório.',
            'payment_method.in' => 'Método de pagamento inválido.',
            
            'zip_code.required' => 'O CEP é obrigatório.',
            'zip_code.regex' => 'O CEP deve estar no formato 00000-000.',
            
            'street.required' => 'A rua é obrigatória.',
            'neighborhood.required' => 'O bairro é obrigatório.',
            'city.required' => 'A cidade é obrigatória.',
            'state.required' => 'O estado é obrigatório.',
            'number.required' => 'O número é obrigatório.',
            
            'card_name.required' => 'O nome no cartão é obrigatório.',
            'card_name.max' => 'O nome no cartão não pode ter mais de 255 caracteres.',
            
            'card_number.required' => 'O número do cartão é obrigatório.',
            'card_number.regex' => 'O número do cartão deve ter 16 dígitos.',
            
            'expiry_date.required' => 'A data de expiração é obrigatória.',
            'expiry_date.regex' => 'A data de expiração deve estar no formato MM/AA.',
            
            'cvc.required' => 'O CVC é obrigatório.',
            'cvc.regex' => 'O CVC deve ter 3 ou 4 dígitos.',
            
            'zip_code.required' => 'O CEP é obrigatório.',
            'zip_code.regex' => 'O CEP deve estar no formato 00000-000 ou 00000000.',
        ];
    }

    /**
     * Get the validated data from the request.
     */
    public function getValidatedData(): array
    {
        return $this->validated();
    }
}
