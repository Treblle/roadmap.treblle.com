<?php

declare(strict_types=1);

namespace App\Events;

use App\DataObjects\Idea;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

final class IdeaWasCreated extends ShouldBeStored
{
    public function __construct(
        public readonly Idea $idea,
    ) {
    }
}
