<?php

declare(strict_types=1);

namespace App\Aggregates;

use App\DataObjects\Token;
use App\Events\TokenWasCreated;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

final class TokenAggregateRoot extends AggregateRoot
{
    public function createToken(Token $token, string $user): TokenAggregateRoot
    {
        $this->recordThat(
            domainEvent: new TokenWasCreated(
                token: $token,
                user: $user,
            ),
        );

        return $this;
    }
}
