<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\EmailVerification;

use App\Http\Controllers\Web\Pages\HomeController;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class VerifyEmailNotificationController
{
    public function __invoke(Request $request): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(
                default: action(HomeController::class),
            );
        }

        $user->sendEmailVerificationNotification();

        $request->session()->flash('message', [
            'heading' => 'Email Verification Sent',
            'message' => 'Your email verification email has been sent.',
        ]);

        return redirect()->back();
    }
}
