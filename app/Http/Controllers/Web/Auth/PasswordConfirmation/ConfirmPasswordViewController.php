<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\PasswordConfirmation;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class ConfirmPasswordViewController
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render(
            component: 'Auth/ConfirmPassword',
        );
    }
}
