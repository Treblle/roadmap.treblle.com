<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\ForgotPassword;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class PasswordResetViewController
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render(
            component: 'Auth/ForgotPassword',
            props: [
                'status' => session('status'),
            ],
        );
    }
}
