<?php

declare(strict_types=1);

namespace App\Commands\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;

final class UpdateUserPassword
{
    public function handle(string $user, string $password): bool
    {
        return DB::transaction(
            callback: static fn () => (bool) User::query()->where('id', $user)->update([
                'password' => $password,
            ]),
            attempts: 2,
        );
    }
}
