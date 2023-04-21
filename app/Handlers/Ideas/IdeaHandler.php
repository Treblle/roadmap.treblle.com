<?php

declare(strict_types=1);

namespace App\Handlers\Ideas;

use App\Events\IdeaWasCreated;
use App\Models\Idea;
use Illuminate\Support\Facades\DB;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

final class IdeaHandler extends Projector
{
    public function onIdeaWasCreated(IdeaWasCreated $event): void
    {
        DB::transaction(
            callback: static fn () => Idea::query()->create(
                attributes:  $event->idea->toArray(),
            ),
            attempts: 2,
        );
    }
}
