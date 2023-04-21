<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Ideas\CreateController;
use App\Http\Controllers\Web\Ideas\ShowController;
use App\Http\Controllers\Web\Ideas\StoreController;
use App\Http\Controllers\Web\Ideas\VoteController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(static function (): void {
    Route::post('/', StoreController::class)->name('store');
    Route::get('create', CreateController::class)->name('create');
    Route::post('vote/{ulid}', VoteController::class)->name('vote');
});

Route::get('{ulid}', ShowController::class)->name('show');
