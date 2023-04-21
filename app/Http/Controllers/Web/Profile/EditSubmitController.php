<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Profile;

use App\Commands\Profile\UpdateProfile;
use App\Http\Requests\Web\Profile\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

final readonly class EditSubmitController
{
    public function __construct(
        private UpdateProfile $command,
    ) {
    }

    public function __invoke(UpdateProfileRequest $request): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        $this->command->handle(
            user: strval($user->getKey()),
            data: (array) $request->validated(),
        );

        if ($user->isDirty('email')) {
            $user->update(['email_verified_at' => null]);
        }

        return new RedirectResponse(
            url: action(EditViewController::class),
        );
    }
}
