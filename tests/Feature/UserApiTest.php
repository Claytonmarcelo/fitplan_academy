<?php

namespace Tests\Feature;

use App\Features\User\Infrastructure\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Testes de Feature - API de Usuários
 * 
 * Testa os endpoints da API de usuários de ponta a ponta.
 * 
 * @package Tests\Feature
 */
class UserApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa listagem de usuários
     * 
     * @return void
     */
    public function test_can_list_users(): void
    {
        // Arrange: Criar usuário autenticado
        $user = User::factory()->create();
        
        // Act: Fazer requisição autenticada
        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/users');

        // Assert: Verificar resposta
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'meta' => [
                    'total',
                    'per_page',
                    'current_page',
                    'last_page',
                ]
            ]);
    }

    /**
     * Testa busca de usuário específico
     * 
     * @return void
     */
    public function test_can_get_user_by_id(): void
    {
        // Arrange
        $user = User::factory()->create();
        
        // Act
        $response = $this->actingAs($user, 'sanctum')
            ->getJson("/api/users/{$user->id}");

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'is_active',
                ]
            ])
            ->assertJson([
                'data' => [
                    'id' => $user->id,
                    'email' => $user->email,
                ]
            ]);
    }

    /**
     * Testa criação de usuário
     * 
     * @return void
     */
    public function test_can_create_user(): void
    {
        // Arrange
        $authenticatedUser = User::factory()->create();
        
        $userData = [
            'name' => 'Novo Usuário',
            'email' => 'novo@email.com',
            'password' => 'senha123',
            'password_confirmation' => 'senha123',
        ];

        // Act
        $response = $this->actingAs($authenticatedUser, 'sanctum')
            ->postJson('/api/users', $userData);

        // Assert
        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'name',
                    'email',
                ]
            ]);

        // Verificar no banco de dados
        $this->assertDatabaseHas('users', [
            'email' => 'novo@email.com',
            'name' => 'Novo Usuário',
        ]);
    }

    /**
     * Testa validação de email duplicado
     * 
     * @return void
     */
    public function test_cannot_create_user_with_duplicate_email(): void
    {
        // Arrange
        $authenticatedUser = User::factory()->create();
        $existingUser = User::factory()->create([
            'email' => 'existente@email.com'
        ]);

        $userData = [
            'name' => 'Tentativa Duplicada',
            'email' => 'existente@email.com',
            'password' => 'senha123',
            'password_confirmation' => 'senha123',
        ];

        // Act
        $response = $this->actingAs($authenticatedUser, 'sanctum')
            ->postJson('/api/users', $userData);

        // Assert
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * Testa atualização de usuário
     * 
     * @return void
     */
    public function test_can_update_user(): void
    {
        // Arrange
        $authenticatedUser = User::factory()->create();
        $userToUpdate = User::factory()->create([
            'name' => 'Nome Antigo'
        ]);

        $updateData = [
            'name' => 'Nome Atualizado',
        ];

        // Act
        $response = $this->actingAs($authenticatedUser, 'sanctum')
            ->putJson("/api/users/{$userToUpdate->id}", $updateData);

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Nome Atualizado',
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $userToUpdate->id,
            'name' => 'Nome Atualizado',
        ]);
    }

    /**
     * Testa deleção de usuário
     * 
     * @return void
     */
    public function test_can_delete_user(): void
    {
        // Arrange
        $authenticatedUser = User::factory()->create();
        $userToDelete = User::factory()->create();

        // Act
        $response = $this->actingAs($authenticatedUser, 'sanctum')
            ->deleteJson("/api/users/{$userToDelete->id}");

        // Assert
        $response->assertStatus(200);
        
        $this->assertDatabaseMissing('users', [
            'id' => $userToDelete->id,
        ]);
    }

    /**
     * Testa acesso não autenticado
     * 
     * @return void
     */
    public function test_unauthenticated_user_cannot_access_api(): void
    {
        // Act
        $response = $this->getJson('/api/users');

        // Assert
        $response->assertStatus(401);
    }
}

