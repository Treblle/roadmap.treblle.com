<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Ideas;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class CreateController
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render(
            component: 'Ideas/Create'
        );
    }
}
