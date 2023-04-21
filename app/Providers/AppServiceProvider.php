<?php

declare(strict_types=1);

namespace App\Providers;

use App\Handlers\Ideas\IdeaHandler;
use App\Handlers\Tokens\TokenHandler;
use App\Handlers\Votes\VoteHandler;
use App\Reactors\UserVotedForIdea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Spatie\EventSourcing\Facades\Projectionist;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Model::shouldBeStrict(
            shouldBeStrict: ! $this->app->environment('production'),
        );

        Projectionist::addProjectors([
            IdeaHandler::class,
            TokenHandler::class,
            VoteHandler::class,
        ]);

        Projectionist::addReactors([
            UserVotedForIdea::class,
        ]);
    }
}
