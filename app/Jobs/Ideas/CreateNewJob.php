<?php

declare(strict_types=1);

namespace App\Jobs\Ideas;

use App\Aggregates\IdeaAggregateRoot;
use App\DataObjects\Idea;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

final class CreateNewJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly Idea $idea,
    ) {
    }

    public function handle(): void
    {
        IdeaAggregateRoot::retrieve(
            uuid: Str::uuid()->toString(),
        )->createIdea(
            idea: $this->idea,
        )->persist();
    }
}
