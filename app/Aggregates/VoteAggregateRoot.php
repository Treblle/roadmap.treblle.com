<?php

declare(strict_types=1);

namespace App\Aggregates;

use App\Events\UserVoted;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

final class VoteAggregateRoot extends AggregateRoot
{
    public function registerVote(string $idea, string $user): VoteAggregateRoot
    {
        $this->recordThat(
            domainEvent: new UserVoted(
                user: $user,
                idea: $idea,
            ),
        );

        return $this;
    }
}
