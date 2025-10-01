<?php

namespace App\Features\Auth\Presentation\Controllers;

use App\Features\Auth\Application\DTOs\LoginDTO;
use App\Features\Auth\Application\DTOs\RegisterDTO;
use App\Features\Auth\Application\UseCases\LoginUseCase;
use App\Features\Auth\Application\UseCases\LogoutUseCase;
use App\Features\Auth\Application\UseCases\RegisterUseCase;
use App\Features\Auth\Presentation\Requests\LoginRequest;
use App\Features\Auth\Presentation\Requests\RegisterRequest;
use App\Features\User\Presentation\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controller - Auth
 * 
 * Controller para autenticação de usuários.
 * Implementa registro, login, logout e consulta de dados do usuário autenticado.
 * 
 * Usa Laravel Sanctum para geração e gerenciamento de tokens.
 * 
 * @package App\Features\Auth\Presentation\Controllers
 */
class AuthController extends Controller
{
    /**
     * Registra um novo usuário
     * 
     * @OA\Post(
     *     path="/api/auth/register",
     *     tags={"Auth"},
     *     summary="Registra novo usuário",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", example="João Silva"),
     *             @OA\Property(property="email", type="string", example="joao@email.com"),
     *             @OA\Property(property="password", type="string", example="senha123"),
     *             @OA\Property(property="password_confirmation", type="string", example="senha123")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Usuário registrado com sucesso")
     * )
     * 
     * @param RegisterRequest $request
     * @param RegisterUseCase $useCase
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, RegisterUseCase $useCase): JsonResponse
    {
        $dto = RegisterDTO::fromArray($request->validated());
        
        $user = $useCase->execute($dto);

        return response()->json([
            'message' => 'Usuário registrado com sucesso',
            'data' => new UserResource($user)
        ], 201);
    }

    /**
     * Realiza login e retorna token de acesso
     * 
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Auth"},
     *     summary="Realiza login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="joao@email.com"),
     *             @OA\Property(property="password", type="string", example="senha123"),
     *             @OA\Property(property="remember", type="boolean", example=false)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Login realizado com sucesso"),
     *     @OA\Response(response=401, description="Credenciais inválidas")
     * )
     * 
     * @param LoginRequest $request
     * @param LoginUseCase $useCase
     * @return JsonResponse
     */
    public function login(LoginRequest $request, LoginUseCase $useCase): JsonResponse
    {
        $dto = LoginDTO::fromArray($request->validated());
        
        $result = $useCase->execute($dto);

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'data' => [
                'user' => new UserResource($result['user']),
                'token' => $result['token'],
                'token_type' => 'Bearer',
            ]
        ]);
    }

    /**
     * Realiza logout (revoga token atual)
     * 
     * @OA\Post(
     *     path="/api/auth/logout",
     *     tags={"Auth"},
     *     summary="Realiza logout",
     *     security={{"sanctum": {}}},
     *     @OA\Response(response=200, description="Logout realizado com sucesso")
     * )
     * 
     * @param Request $request
     * @param LogoutUseCase $useCase
     * @return JsonResponse
     */
    public function logout(Request $request, LogoutUseCase $useCase): JsonResponse
    {
        $useCase->execute($request);

        return response()->json([
            'message' => 'Logout realizado com sucesso'
        ]);
    }

    /**
     * Retorna dados do usuário autenticado
     * 
     * @OA\Get(
     *     path="/api/auth/me",
     *     tags={"Auth"},
     *     summary="Dados do usuário autenticado",
     *     security={{"sanctum": {}}},
     *     @OA\Response(response=200, description="Dados do usuário")
     * )
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        // $request->user() retorna o model Eloquent
        // Precisamos converter para entidade de domínio
        $userModel = $request->user();
        
        $userRepository = app(\App\Features\User\Domain\Repositories\UserRepositoryInterface::class);
        $user = $userRepository->findById($userModel->id);

        return response()->json([
            'data' => new UserResource($user)
        ]);
    }
}

