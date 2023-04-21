<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\EmailVerification;

use App\Http\Controllers\Web\Pages\HomeController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class VerifyEmailViewController
{
    public function __invoke(Request $request): Response|RedirectResponse
    {
        return $request->user()?->hasVerifiedEmail()
            ? redirect()->intended(
                default: action(HomeController::class),
            ) : Inertia::render(
                component: 'Auth/VerifyEmail',
                props: [
                    'status' => fn () => session('status'),
                ],
            );
    }
}
