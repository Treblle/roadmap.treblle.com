<?php

declare(strict_types=1);

namespace App\Services\Reporting;

use App\Enums\EventMap;
use Illuminate\Database\Eloquent\Collection;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;

final class RoadmapReports
{
    private array $log = [];

    public function ideasCreated(): array
    {
        $events = EloquentStoredEvent::query()
            ->where('event_class', EventMap::IDEA_CREATED->value)
            ->get();

        /** @phpstan-ignore-next-line  */
        $events->each(function (EloquentStoredEvent $event): void {
            $idea = $event->event_properties['idea'];

            if (empty($idea)) {
                return;
            }

            $this->log[] = $idea['name'].' was created under '.$idea['category']['value'];
        });

        return $this->log;
    }

    public function votes(): Collection
    {
        return EloquentStoredEvent::query()
            ->where('event_class', EventMap::USER_VOTED->value)
            ->get();
    }
}
