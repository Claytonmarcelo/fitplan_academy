<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Features\User\Infrastructure\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

/**
 * RegisterController
 * 
 * Controller responsável pelo registro de novos usuários.
 * Inclui validações brasileiras completas (CPF, CEP, telefone).
 */
class RegisterController extends Controller
{
    /**
     * Exibe o formulário de registro
     */
    public function showRegister()
    {
        $semPlano = request()->route()->parameter('sem_plano', false);
        return view('auth.register', compact('semPlano'));
    }

    /**
     * Processa o registro do usuário
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            // Dados pessoais
            'name' => [
                'required',
                'string',
                'min:8',
                'max:60',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/'
            ],
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:M,F,O',
            'mother_name' => [
                'required',
                'string',
                'min:8',
                'max:60',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/'
            ],
            'cpf' => [
                'required',
                'string',
                'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
                function ($attribute, $value, $fail) {
                    if (!$this->validateCpf($value)) {
                        $fail('O CPF informado é inválido.');
                    }
                },
            ],
            'email' => 'required|email',
            'phone_cell' => [
                'required',
                'string',
                'regex:/^\(\+55\)\d{2}-\d{5}-\d{4}$/'
            ],
            'phone_fixed' => [
                'required',
                'string',
                'regex:/^\(\+55\)\d{2}-\d{4}-\d{4}$/'
            ],
            
            // Endereço completo
            'cep' => [
                'required',
                'string',
                'regex:/^\d{5}-\d{3}$/'
            ],
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'complement' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|size:2',
            
            // Credenciais
            'login' => [
                'required',
                'string',
                'size:6',
                'regex:/^[A-Za-z]{6}$/',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^[A-Za-z]{8,}$/',
                'confirmed'
            ],
            'password_confirmation' => 'required|string|min:8',
            
        ], [
            // Mensagens personalizadas
            'name.required' => 'O nome é obrigatório.',
            'name.min' => 'O nome deve ter pelo menos 8 caracteres.',
            'name.max' => 'O nome deve ter no máximo 60 caracteres.',
            'name.regex' => 'O nome deve conter apenas letras.',
            
            'birth_date.required' => 'A data de nascimento é obrigatória.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'birth_date.before' => 'A data de nascimento deve ser anterior a hoje.',
            
            'gender.required' => 'O sexo é obrigatório.',
            'gender.in' => 'O sexo deve ser Masculino, Feminino ou Outro.',
            
            'mother_name.required' => 'O nome da mãe é obrigatório.',
            'mother_name.min' => 'O nome da mãe deve ter pelo menos 8 caracteres.',
            'mother_name.max' => 'O nome da mãe deve ter no máximo 60 caracteres.',
            'mother_name.regex' => 'O nome da mãe deve conter apenas letras.',
            
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.regex' => 'O CPF deve estar no formato 000.000.000-00.',
            
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ter um formato válido.',
            
            'phone_cell.required' => 'O telefone celular é obrigatório.',
            'phone_cell.regex' => 'O telefone celular deve estar no formato (+55)XX-XXXXX-XXXX.',
            
            'phone_fixed.required' => 'O telefone fixo é obrigatório.',
            'phone_fixed.regex' => 'O telefone fixo deve estar no formato (+55)XX-XXXX-XXXX.',
            
            'cep.required' => 'O CEP é obrigatório.',
            'cep.regex' => 'O CEP deve estar no formato 00000-000.',
            
            'street.required' => 'O logradouro é obrigatório.',
            'number.required' => 'O número é obrigatório.',
            'complement.required' => 'O complemento é obrigatório.',
            'district.required' => 'O bairro é obrigatório.',
            'city.required' => 'A cidade é obrigatória.',
            'state.required' => 'O estado é obrigatório.',
            'state.size' => 'O estado deve ter 2 caracteres.',
            
            'login.required' => 'O login é obrigatório.',
            'login.size' => 'O login deve ter exatamente 6 caracteres.',
            'login.regex' => 'O login deve conter apenas letras.',
            
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.regex' => 'A senha deve conter apenas caracteres alfabéticos.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ]);

        // Validar CEP com API
        if (!$this->validateCepWithApi($validated['cep'])) {
            return back()->withErrors([
                'cep' => 'CEP não encontrado ou inválido.'
            ])->withInput();
        }

        // Criar usuário no banco de dados
        try {
            $user = User::create([
                'name' => $validated['name'],
                'birth_date' => $validated['birth_date'],
                'gender' => $validated['gender'],
                'mother_name' => $validated['mother_name'],
                'cpf' => $validated['cpf'],
                'email' => $validated['email'],
                'phone' => $validated['phone_cell'],
                'landline_phone' => $validated['phone_fixed'],
                'cep' => $validated['cep'],
                'street' => $validated['street'],
                'number' => $validated['number'],
                'complement' => $validated['complement'],
                'district' => $validated['district'],
                'city' => $validated['city'],
                'state' => strtoupper($validated['state']),
                'zip_code' => $validated['cep'], // Mesmo valor do CEP
                'login' => strtoupper($validated['login']),
                'password' => Hash::make($validated['password']), // Senha criptografada
                'role' => 'common',
                'is_active' => true,
            ]);

            // Fazer login automático do usuário
            auth()->login($user);

            return redirect()->route('student.dashboard')
                            ->with('success', 'Cadastro realizado com sucesso! Bem-vindo, ' . $user->name . '!');

        } catch (\Exception $e) {
            return back()->withErrors([
                'general' => 'Erro ao criar conta. Tente novamente.'
            ])->withInput();
        }
    }

    /**
     * Valida CPF usando algoritmo de dígito verificador
     */
    private function validateCpf(string $cpf): bool
    {
        // Remove formatação
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        // Verifica se tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }
        
        // Verifica se todos os dígitos são iguais
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        
        // Calcula o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += $cpf[$i] * (10 - $i);
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;
        
        // Verifica o primeiro dígito
        if ($cpf[9] != $digito1) {
            return false;
        }
        
        // Calcula o segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += $cpf[$i] * (11 - $i);
        }
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;
        
        // Verifica o segundo dígito
        return $cpf[10] == $digito2;
    }

    /**
     * Valida CEP com API ViaCEP
     */
    private function validateCepWithApi(string $cep): bool
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);
        
        try {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
            $data = $response->json();
            
            return !isset($data['erro']);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Busca endereço por CEP via AJAX
     */
    public function searchCep(Request $request)
    {
        $request->validate([
            'cep' => 'required|regex:/^\d{5}-?\d{3}$/'
        ]);

        $cep = preg_replace('/[^0-9]/', '', $request->cep);

        try {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
            $data = $response->json();

            if (isset($data['erro'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'CEP não encontrado.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'street' => $data['logradouro'],
                    'district' => $data['bairro'],
                    'city' => $data['localidade'],
                    'state' => $data['uf']
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao consultar CEP. Tente novamente.'
            ], 500);
        }
    }
}
