<?php

declare(strict_types=1);

namespace App\Events;

use App\DataObjects\Token;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

final class TokenWasCreated extends ShouldBeStored
{
    public function __construct(
        public readonly Token $token,
        public readonly string $user,
    ) {
    }
}
