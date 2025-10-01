<?php

namespace App\Features\Checkout\Application\DTOs;

/**
 * DTO para resposta de checkout
 * 
 * Contém os dados de resposta após processamento do checkout
 */
class CheckoutResponseDTO
{
    public function __construct(
        public readonly bool $success,
        public readonly string $message,
        public readonly ?int $checkoutId = null,
        public readonly ?string $redirectUrl = null,
        public readonly ?string $transactionId = null,
        public readonly ?array $errors = null
    ) {}

    /**
     * Cria resposta de sucesso
     */
    public static function success(string $message, int $checkoutId, ?string $redirectUrl = null, ?string $transactionId = null): self
    {
        return new self(
            success: true,
            message: $message,
            checkoutId: $checkoutId,
            redirectUrl: $redirectUrl,
            transactionId: $transactionId
        );
    }

    /**
     * Cria resposta de erro
     */
    public static function error(string $message, array $errors = []): self
    {
        return new self(
            success: false,
            message: $message,
            errors: $errors
        );
    }

    /**
     * Converte para array
     */
    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
            'checkout_id' => $this->checkoutId,
            'redirect_url' => $this->redirectUrl,
            'transaction_id' => $this->transactionId,
            'errors' => $this->errors
        ];
    }
}
