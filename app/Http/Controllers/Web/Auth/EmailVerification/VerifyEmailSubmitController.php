<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\EmailVerification;

use App\Http\Controllers\Web\Pages\HomeController;
use App\Http\Requests\Web\Auth\EmailVerificationRequest;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

final class VerifyEmailSubmitController
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(
                default: action(HomeController::class.'?verified=1'),
            );
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified(
                user: $user,
            ));
        }

        return redirect()->intended(
            default: action(HomeController::class.'?verified=1'),
        );
    }
}
