<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Ideas;

use App\Http\Controllers\Web\Pages\HomeController;
use App\Http\Requests\Web\Ideas\StoreRequest;
use App\Jobs\Ideas\CreateNewJob;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;

final readonly class StoreController
{
    public function __construct(
        private Authenticatable $user,
    ) {
    }

    public function __invoke(StoreRequest $request): RedirectResponse
    {
        dispatch(new CreateNewJob(
            idea: $request->payload(
                user: strval($this->user->getAuthIdentifier()),
            ),
        ));

        return new RedirectResponse(
            url: action(HomeController::class),
        );
    }
}
