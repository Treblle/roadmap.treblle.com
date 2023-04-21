<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\ResetPassword;

use App\Commands\Auth\ResetUserPassword;
use App\Http\Controllers\Web\Auth\Login\LoginViewController;
use App\Http\Requests\Web\Auth\ResetPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

final readonly class PasswordUpdateSubmitController
{
    public function __construct(
        private ResetUserPassword $command,
    ) {
    }

    /**
     * @throws ValidationException
     */
    public function __invoke(ResetPasswordRequest $request): RedirectResponse
    {
        $status = $this->command->handle(
            passwordReset: $request->payload(),
        );

        if (Password::PASSWORD_RESET === $status) {
            $request->session()->flash('message', [
                'heading' => 'Password Reset',
                'contents' => __($status),
            ]);
            return new RedirectResponse(
                url: action(LoginViewController::class),
            );
        }

        throw ValidationException::withMessages(
            messages: [
                'email' => [trans(strval($status))],
            ],
        );
    }
}
