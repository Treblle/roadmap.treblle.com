<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\Role;
use App\Models\Idea;
use App\Models\User;

final class IdeaPolicy
{
    public function update(User $user, Idea $idea): bool
    {
        if ($this->internal($user)) {
            return true;
        }

        return $idea->getAttribute('user_id') === $user->getKey();
    }


    private function internal(User $user): bool
    {
        return Role::USER !== $user->getAttribute('role');
    }
}
