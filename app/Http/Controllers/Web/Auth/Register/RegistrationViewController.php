<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\Register;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class RegistrationViewController
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render(
            component: 'Auth/Register',
        );
    }
}
