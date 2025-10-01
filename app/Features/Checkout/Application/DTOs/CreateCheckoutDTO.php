<?php

namespace App\Features\Checkout\Application\DTOs;

/**
 * DTO para criação de checkout
 * 
 * Contém todos os dados necessários para criar um novo checkout
 */
class CreateCheckoutDTO
{
    public function __construct(
        public readonly int $planId,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $cpf,
        public readonly string $paymentMethod,
        public readonly ?string $cardName = null,
        public readonly ?string $cardNumber = null,
        public readonly ?string $expiryDate = null,
        public readonly ?string $cvc = null,
        public readonly string $zipCode,
        public readonly string $street,
        public readonly string $neighborhood,
        public readonly string $city,
        public readonly string $state,
        public readonly string $number,
        public readonly ?string $complement = null,
        public readonly float $subtotal,
        public readonly float $taxes,
        public readonly float $total
    ) {}

    /**
     * Cria DTO a partir de array de dados
     */
    public static function fromArray(array $data): self
    {
        return new self(
            planId: (int) $data['plan_id'],
            firstName: $data['first_name'],
            lastName: $data['last_name'],
            email: $data['email'],
            phone: $data['phone'],
            cpf: $data['cpf'],
            paymentMethod: $data['payment_method'],
            cardName: $data['card_name'] ?? null,
            cardNumber: $data['card_number'] ?? null,
            expiryDate: $data['expiry_date'] ?? null,
            cvc: $data['cvc'] ?? null,
            zipCode: $data['zip_code'],
            street: $data['street'],
            neighborhood: $data['neighborhood'],
            city: $data['city'],
            state: $data['state'],
            number: $data['number'],
            complement: $data['complement'] ?? null,
            subtotal: (float) $data['subtotal'],
            taxes: (float) $data['taxes'],
            total: (float) $data['total']
        );
    }

    /**
     * Converte para array
     */
    public function toArray(): array
    {
        return [
            'plan_id' => $this->planId,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'cpf' => $this->cpf,
            'payment_method' => $this->paymentMethod,
            'card_name' => $this->cardName,
            'card_number' => $this->cardNumber,
            'expiry_date' => $this->expiryDate,
            'cvc' => $this->cvc,
            'zip_code' => $this->zipCode,
            'street' => $this->street,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'state' => $this->state,
            'number' => $this->number,
            'complement' => $this->complement,
            'subtotal' => $this->subtotal,
            'taxes' => $this->taxes,
            'total' => $this->total
        ];
    }

    /**
     * Valida se todos os campos obrigatórios estão presentes
     */
    public function isValid(): bool
    {
        $valid = !empty($this->firstName)
            && !empty($this->lastName)
            && !empty($this->email)
            && !empty($this->phone)
            && !empty($this->cpf)
            && !empty($this->paymentMethod)
            && !empty($this->zipCode)
            && !empty($this->street)
            && !empty($this->neighborhood)
            && !empty($this->city)
            && !empty($this->state)
            && !empty($this->number)
            && $this->planId > 0
            && $this->total > 0;

        // Se for cartão de crédito, validar campos do cartão
        if ($this->paymentMethod === 'credit_card') {
            $valid = $valid 
                && !empty($this->cardName)
                && !empty($this->cardNumber)
                && !empty($this->expiryDate)
                && !empty($this->cvc);
        }

        return $valid;
    }
}
