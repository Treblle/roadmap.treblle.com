<?php

declare(strict_types=1);

namespace App\Handlers\Votes;

use App\Events\UserVoted;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

final class VoteHandler extends Projector
{
    public function onUserVoted(UserVoted $event): void
    {
        DB::transaction(
            callback: fn () => Vote::query()->create(
                attributes: [
                    'user_id' => $event->user,
                    'idea_id' => $event->idea,
                ],
            ),
            attempts: 2,
        );
    }
}
