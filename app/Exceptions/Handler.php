<?php

namespace App\Exceptions;

use App\Shared\Exceptions\BusinessException;
use App\Shared\Exceptions\NotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

/**
 * Exception Handler
 * 
 * Handler global de exceções da aplicação.
 * Transforma exceções em respostas HTTP apropriadas.
 * 
 * Responsabilidades:
 * - Capturar e formatar exceções
 * - Retornar respostas JSON consistentes para APIs
 * - Logar erros apropriadamente
 * 
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * Lista de exceções que não devem ser reportadas
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * Lista de inputs que nunca devem aparecer em logs
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Registra callbacks de tratamento de exceções
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        /**
         * Renderiza exceções customizadas para API
         * Retorna JSON padronizado com mensagem e código de status adequados
         */
        $this->renderable(function (Throwable $e, $request) {
            // Se não for uma requisição à API, deixa o Laravel tratar normalmente
            if (!$request->is('api/*')) {
                return null;
            }

            // Trata exceções de negócio
            if ($e instanceof BusinessException) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage(),
                    'code' => $e->getCode()
                ], $e->getCode());
            }

            // Trata exceções de recurso não encontrado
            if ($e instanceof NotFoundException || $e instanceof NotFoundHttpException) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage() ?: 'Recurso não encontrado',
                    'code' => 404
                ], 404);
            }

            // Trata erros de validação
            if ($e instanceof ValidationException) {
                return response()->json([
                    'error' => true,
                    'message' => 'Erro de validação',
                    'errors' => $e->errors(),
                    'code' => 422
                ], 422);
            }

            // Erros genéricos
            // Em produção, não expõe detalhes do erro
            if (config('app.debug')) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage(),
                    'code' => 500,
                    'trace' => $e->getTraceAsString()
                ], 500);
            }

            return response()->json([
                'error' => true,
                'message' => 'Erro interno do servidor',
                'code' => 500
            ], 500);
        });
    }
}

