<?php

namespace App\Features\User\Presentation\Resources;

use App\Features\User\Domain\Entities\UserEntity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * API Resource - User
 * 
 * Transforma a entidade User em uma representação JSON para a API.
 * 
 * Responsabilidades:
 * - Serializar dados para JSON
 * - Ocultar campos sensíveis (password)
 * - Formatar datas
 * - Estruturar resposta consistente
 * 
 * Performance: Serialização otimizada do Laravel
 * 
 * @package App\Features\User\Presentation\Resources
 */
class UserResource extends JsonResource
{
    /**
     * Transforma o resource em um array
     * 
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var UserEntity $user */
        $user = $this->resource;

        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'is_active' => $user->isActive(),
            'email_verified_at' => $user->getEmailVerifiedAt()?->format('Y-m-d H:i:s'),
            'created_at' => $user->getCreatedAt()?->format('Y-m-d H:i:s'),
            'updated_at' => $user->getUpdatedAt()?->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Customiza o wrapper da resposta
     * 
     * @param Request $request
     * @param array $paginated
     * @return array
     */
    public static function collection($resource)
    {
        return parent::collection($resource);
    }
}

