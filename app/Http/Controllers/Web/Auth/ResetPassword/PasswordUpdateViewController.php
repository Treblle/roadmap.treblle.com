<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\ResetPassword;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class PasswordUpdateViewController
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render(
            component: 'Auth/ResetPassword',
            props: [
                'email' => fn () => $request->string('email')->toString(),
                'token' => fn () => $request->route('token'),
            ],
        );
    }
}
