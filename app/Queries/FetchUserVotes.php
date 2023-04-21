<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Builder;

final class FetchUserVotes
{
    public function handle(string $user): Builder
    {
        return Vote::query()->where('user_id', $user);
    }
}
