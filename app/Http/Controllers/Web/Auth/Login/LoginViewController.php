<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

final class LoginViewController
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render(
            component: 'Auth/Login',
            props: [
                'canResetPassword' => fn () => Route::has('password.request'),
                'status' => fn () => session('status'),
            ],
        );
    }
}
