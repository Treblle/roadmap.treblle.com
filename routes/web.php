<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::as('static:')->group(base_path(
    'routes/web/static.php'
));

Route::middleware([])->group(
    base_path('routes/web/auth.php'),
);

Route::prefix('ideas')->as('ideas:')->group(
    base_path('routes/web/ideas.php'),
);

Route::middleware(['auth'])->prefix('manage')->as('manage:')->group(
    base_path('routes/web/manage.php'),
);

Route::middleware(['auth'])->prefix('profile')->as('profile:')->group(
    base_path('routes/web/profile.php'),
);
