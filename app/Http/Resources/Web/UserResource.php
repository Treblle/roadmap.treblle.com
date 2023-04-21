<?php

declare(strict_types=1);

namespace App\Http\Resources\Web;

use App\Enums\Role;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string $avatar
 * @property-read Role $role
 */
final class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'role' => new RoleResource(
                resource: $this->role,
            ),
        ];
    }
}
