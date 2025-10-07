<?php

namespace App\Features\Success\Application\DTOs;

/**
 * DTO para resposta da feature Success
 * 
 * Contém todos os dados necessários para renderizar a página de sucesso
 * Seguindo o padrão DTO para transferência de dados
 * 
 * @package App\Features\Success\Application\DTOs
 * @author FitPlan Academy Team
 * @version 1.0.0
 */
class SuccessResponseDTO
{
    public function __construct(
        public readonly bool $success,
        public readonly string $title,
        public readonly string $message,
        public readonly string $userName,
        public readonly string $planName,
        public readonly string $formattedPrice,
        public readonly string $transactionId,
        public readonly string $formattedDate,
        public readonly string $nextSteps,
        public readonly string $supportEmail,
        public readonly string $accountUrl,
        public readonly array $metadata = []
    ) {}

    /**
     * Cria DTO de sucesso
     */
    public static function success(
        string $title,
        string $message,
        string $userName,
        string $planName,
        string $formattedPrice,
        string $transactionId,
        string $formattedDate,
        string $nextSteps = 'Acesse sua conta para começar a usar o plano.',
        string $supportEmail = 'suporte@fitplan.com',
        string $accountUrl = '/dashboard',
        array $metadata = []
    ): self {
        return new self(
            success: true,
            title: $title,
            message: $message,
            userName: $userName,
            planName: $planName,
            formattedPrice: $formattedPrice,
            transactionId: $transactionId,
            formattedDate: $formattedDate,
            nextSteps: $nextSteps,
            supportEmail: $supportEmail,
            accountUrl: $accountUrl,
            metadata: $metadata
        );
    }

    /**
     * Cria DTO de erro
     */
    public static function error(
        string $title,
        string $message,
        string $supportEmail = 'suporte@fitplan.com'
    ): self {
        return new self(
            success: false,
            title: $title,
            message: $message,
            userName: '',
            planName: '',
            formattedPrice: '',
            transactionId: '',
            formattedDate: '',
            nextSteps: 'Entre em contato com o suporte para mais informações.',
            supportEmail: $supportEmail,
            accountUrl: '/',
            metadata: []
        );
    }

    /**
     * Converte para array para view
     */
    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'title' => $this->title,
            'message' => $this->message,
            'user_name' => $this->userName,
            'plan_name' => $this->planName,
            'formatted_price' => $this->formattedPrice,
            'transaction_id' => $this->transactionId,
            'formatted_date' => $this->formattedDate,
            'next_steps' => $this->nextSteps,
            'support_email' => $this->supportEmail,
            'account_url' => $this->accountUrl,
            'metadata' => $this->metadata
        ];
    }
}








