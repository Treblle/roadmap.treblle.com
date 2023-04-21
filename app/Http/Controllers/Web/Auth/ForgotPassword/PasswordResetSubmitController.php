<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\ForgotPassword;

use App\Http\Controllers\Web\Auth\Login\LoginViewController;
use App\Http\Requests\Web\Auth\ForgotPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

final class PasswordResetSubmitController
{
    /**
     * @throws ValidationException
     */
    public function __invoke(ForgotPasswordRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink(
            credentials: $request->only('email')
        );

        if (Password::RESET_LINK_SENT === $status) {
            $request->session()->flash('message', [
                'heading' => 'Password Reset Email Sent',
                'contents' => __($status),
            ]);
            return new RedirectResponse(
                url: action(LoginViewController::class),
            );
        }

        throw ValidationException::withMessages(
            messages: [
                'email' => [
                    trans($status),
                ],
            ],
        );
    }
}
