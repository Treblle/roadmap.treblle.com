<?php

declare(strict_types=1);

namespace App\Jobs\Ideas;

use App\Aggregates\VoteAggregateRoot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

final class RegisterUserVote implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly string $user,
        public readonly string $idea,
    ) {
    }

    public function handle(): void
    {
        VoteAggregateRoot::retrieve(
            uuid: Str::uuid()->toString(),
        )->registerVote(
            idea: $this->idea,
            user: $this->user,
        )->persist();
    }
}
