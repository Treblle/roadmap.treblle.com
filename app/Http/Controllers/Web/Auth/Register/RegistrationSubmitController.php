<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\Register;

use App\Commands\Auth\CreateNewUser;
use App\Http\Controllers\Web\Pages\HomeController;
use App\Http\Requests\Web\Auth\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final readonly class RegistrationSubmitController
{
    public function __construct(
        private CreateNewUser $command,
    ) {
    }

    public function __invoke(RegistrationRequest $request): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = $this->command->handle(
            registration: $request->payload(),
        );

        Auth::login($user);

        return new RedirectResponse(
            url: action(HomeController::class),
        );
    }
}
