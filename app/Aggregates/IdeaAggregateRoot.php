<?php

declare(strict_types=1);

namespace App\Aggregates;

use App\DataObjects\Idea;
use App\Events\IdeaWasCreated;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

final class IdeaAggregateRoot extends AggregateRoot
{
    /**
     * @param Idea $idea
     * @return IdeaAggregateRoot
     */
    public function createIdea(Idea $idea): IdeaAggregateRoot
    {
        $this->recordThat(
            domainEvent: new IdeaWasCreated(
                idea: $idea,
            ),
        );

        return $this;
    }
}
