<?php

declare(strict_types=1);

namespace App\Commands\Profile;

use App\Models\User;
use Illuminate\Support\Facades\DB;

final class UpdateProfile
{
    public function handle(string $user, array $data): bool
    {
        return DB::transaction(
            callback: static fn () => (bool) User::query()
                ->where('id', $user)
                ->update($data),
            attempts: 2,
        );
    }
}
