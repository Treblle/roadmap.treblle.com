<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\PasswordConfirmation;

use App\Http\Controllers\Web\Pages\HomeController;
use App\Http\Requests\Web\Auth\PasswordConfirmationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

final class ConfirmPasswordSubmitController
{
    /**
     * @throws ValidationException
     */
    public function __invoke(PasswordConfirmationRequest $request): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        if ( ! Auth::guard('web')->validate([
            'email' => $user->email,
            'password' => $request->string('password')->toString(),
        ])) {
            throw ValidationException::withMessages(
                messages: [
                    'password' => __('auth.password'),
                ],
            );
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(
            default: action(HomeController::class),
        );
    }
}
