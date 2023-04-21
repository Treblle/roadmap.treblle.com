<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Manage\Api;

use App\Enums\Permission;
use App\Http\Resources\PermissionResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Sanctum\PersonalAccessToken;

final class TokensController
{
    public function __invoke(Request $request): Response
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        return Inertia::render(
            component: 'API/Index',
            props: [
                'tokens' => fn () => $user->tokens->map(function ($token) {
                    /**
                     * @var PersonalAccessToken $token
                     */
                    return [
                        ...$token->toArray(),
                        'last_used_ago' => $token->last_used_at?->diffForHumans(),
                    ];
                }),
                'availablePermissions' => fn () => PermissionResource::collection(
                    resource: Permission::cases(),
                ),
            ],
        );
    }
}
