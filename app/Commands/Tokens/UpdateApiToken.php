<?php

declare(strict_types=1);

namespace App\Commands\Tokens;

use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

final class UpdateApiToken
{
    public function handle(string|int $token, array $abilities = []): bool
    {
        return DB::transaction(
            callback: fn () => (bool) PersonalAccessToken::query()->where('id', $token)->update([
                'abilities' => $abilities,
            ]),
            attempts: 2,
        );
    }
}
