<?php

declare(strict_types=1);

namespace App\Reactors;

use App\Events\UserVoted;
use App\Models\Idea;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;

final class UserVotedForIdea extends Reactor implements ShouldQueue
{
    public function onUserVoted(UserVoted $event): void
    {
        DB::transaction(
            callback: fn () => Idea::query()
                ->where('id', $event->idea)
                ->increment('votes'),
            attempts: 2,
        );
    }
}
