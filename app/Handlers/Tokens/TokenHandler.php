<?php

declare(strict_types=1);

namespace App\Handlers\Tokens;

use App\Events\TokenWasCreated;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

final class TokenHandler extends Projector
{
    public function onTokenWasCreated(TokenWasCreated $event): void
    {
        /**
         * @var User $user
         */
        $user = User::query()->find(
            id: $event->user,
        );

        DB::transaction(
            callback: static fn () => $user->createNewToken(
                name: $event->token->name,
                abilities: $event->token->abilities,
                token: $event->token->token,
            ),
            attempts: 2,
        );
    }
}
