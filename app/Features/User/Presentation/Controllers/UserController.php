<?php

namespace App\Features\User\Presentation\Controllers;

use App\Features\User\Application\DTOs\CreateUserDTO;
use App\Features\User\Application\DTOs\UpdateUserDTO;
use App\Features\User\Application\UseCases\CreateUserUseCase;
use App\Features\User\Application\UseCases\DeleteUserUseCase;
use App\Features\User\Application\UseCases\GetUserUseCase;
use App\Features\User\Application\UseCases\ListUsersUseCase;
use App\Features\User\Application\UseCases\UpdateUserUseCase;
use App\Features\User\Presentation\Requests\CreateUserRequest;
use App\Features\User\Presentation\Requests\UpdateUserRequest;
use App\Features\User\Presentation\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controller - User
 * 
 * Controller REST API para gerenciamento de usuários.
 * Segue os princípios RESTful com respostas JSON padronizadas.
 * 
 * Responsabilidades:
 * - Receber requisições HTTP
 * - Validar dados (via FormRequest)
 * - Chamar Use Cases apropriados
 * - Retornar respostas formatadas
 * 
 * Performance Tips:
 * - Use cases são injetados via DI (otimizado pelo Laravel)
 * - Resources serializam dados eficientemente
 * - Validação acontece antes da lógica de negócio
 * 
 * @package App\Features\User\Presentation\Controllers
 */
class UserController extends Controller
{
    /**
     * Lista todos os usuários (paginado)
     * 
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Lista usuários",
     *     @OA\Parameter(name="per_page", in="query", description="Itens por página"),
     *     @OA\Parameter(name="page", in="query", description="Página atual"),
     *     @OA\Response(response=200, description="Lista de usuários")
     * )
     * 
     * @param Request $request
     * @param ListUsersUseCase $useCase
     * @return JsonResponse
     */
    public function index(Request $request, ListUsersUseCase $useCase): JsonResponse
    {
        $perPage = (int) $request->get('per_page', 15);
        $page = (int) $request->get('page', 1);

        $result = $useCase->execute($perPage, $page);

        return response()->json([
            'data' => UserResource::collection($result['data']),
            'meta' => [
                'total' => $result['total'],
                'per_page' => $result['per_page'],
                'current_page' => $result['current_page'],
                'last_page' => $result['last_page'],
            ]
        ]);
    }

    /**
     * Exibe um usuário específico
     * 
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Busca usuário por ID",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do usuário"),
     *     @OA\Response(response=200, description="Usuário encontrado"),
     *     @OA\Response(response=404, description="Usuário não encontrado")
     * )
     * 
     * @param int $id
     * @param GetUserUseCase $useCase
     * @return JsonResponse
     */
    public function show(int $id, GetUserUseCase $useCase): JsonResponse
    {
        $user = $useCase->execute($id);

        return response()->json([
            'data' => new UserResource($user)
        ]);
    }

    /**
     * Cria um novo usuário
     * 
     * @OA\Post(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Cria novo usuário",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", example="João Silva"),
     *             @OA\Property(property="email", type="string", example="joao@email.com"),
     *             @OA\Property(property="password", type="string", example="senha123"),
     *             @OA\Property(property="password_confirmation", type="string", example="senha123"),
     *             @OA\Property(property="is_active", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Usuário criado com sucesso"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     * 
     * @param CreateUserRequest $request Validação automática
     * @param CreateUserUseCase $useCase
     * @return JsonResponse
     */
    public function store(CreateUserRequest $request, CreateUserUseCase $useCase): JsonResponse
    {
        // Request já está validado pelo FormRequest
        $dto = CreateUserDTO::fromArray($request->validated());

        $user = $useCase->execute($dto);

        return response()->json([
            'message' => 'Usuário criado com sucesso',
            'data' => new UserResource($user)
        ], 201);
    }

    /**
     * Atualiza um usuário existente
     * 
     * @OA\Put(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Atualiza usuário",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do usuário"),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string"),
     *             @OA\Property(property="password_confirmation", type="string"),
     *             @OA\Property(property="is_active", type="boolean")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Usuário atualizado"),
     *     @OA\Response(response=404, description="Usuário não encontrado"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     * 
     * @param int $id
     * @param UpdateUserRequest $request Validação automática
     * @param UpdateUserUseCase $useCase
     * @return JsonResponse
     */
    public function update(int $id, UpdateUserRequest $request, UpdateUserUseCase $useCase): JsonResponse
    {
        $dto = UpdateUserDTO::fromArray($id, $request->validated());

        $user = $useCase->execute($dto);

        return response()->json([
            'message' => 'Usuário atualizado com sucesso',
            'data' => new UserResource($user)
        ]);
    }

    /**
     * Deleta um usuário
     * 
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Deleta usuário",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do usuário"),
     *     @OA\Response(response=200, description="Usuário deletado"),
     *     @OA\Response(response=404, description="Usuário não encontrado")
     * )
     * 
     * @param int $id
     * @param DeleteUserUseCase $useCase
     * @return JsonResponse
     */
    public function destroy(int $id, DeleteUserUseCase $useCase): JsonResponse
    {
        $useCase->execute($id);

        return response()->json([
            'message' => 'Usuário deletado com sucesso'
        ]);
    }
}

