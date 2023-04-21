<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Ideas;

use App\Exceptions\Ideas\AlreadyVoted;
use App\Exceptions\Ideas\IdeaNotRegistered;
use App\Jobs\Ideas\RegisterUserVote;
use App\Queries\FetchIdeas;
use App\Queries\FetchUserVotes;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Treblle\Tools\Http\Enums\Status;

final readonly class VoteController
{
    public function __construct(
        private FetchIdeas $query,
        private Authenticatable $user,
        private FetchUserVotes $votes,
    ) {
    }

    public function __invoke(Request $request, string $ulid): void
    {
        $idea = $this->query->handle()->find(
            id: $ulid,
        );

        if ( ! $idea) {
            throw new IdeaNotRegistered(
                message: "Cannot find an Idea identified with [{$ulid}].",
                code: Status::NOT_FOUND->value,
            );
        }

        $voted = $this->votes->handle(
            user: strval($this->user->getAuthIdentifier()),
        )->where('idea_id', $ulid)->count();

        if ($voted) {
            throw new AlreadyVoted(
                message: "You have already voted for this idea.",
                code: Status::UNPROCESSABLE_CONTENT->value,
            );
        }

        dispatch(new RegisterUserVote(
            user: strval($this->user->getAuthIdentifier()),
            idea: $ulid,
        ));
    }
}
