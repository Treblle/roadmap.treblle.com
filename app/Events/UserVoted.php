<?php

declare(strict_types=1);

namespace App\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

final class UserVoted extends ShouldBeStored
{
    public function __construct(
        public readonly string $user,
        public readonly string $idea,
    ) {
    }
}
