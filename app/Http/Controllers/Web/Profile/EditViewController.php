<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Profile;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class EditViewController
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render(
            component: 'Profile/Edit',
            props: [
                'mustVerifyEmail' => fn () => true,
                'status' => fn () => session('status'),
            ],
        );
    }
}
