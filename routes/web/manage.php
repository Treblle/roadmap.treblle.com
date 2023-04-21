<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Manage\Api\DeleteController;
use App\Http\Controllers\Web\Manage\Api\StoreTokenController;
use App\Http\Controllers\Web\Manage\Api\TokensController;
use App\Http\Controllers\Web\Manage\Api\UpdateController;
use App\Http\Controllers\Web\Manage\Ideas\IndexController;
use Illuminate\Support\Facades\Route;

Route::prefix('ideas')->as('ideas:')->group(static function (): void {
    Route::get('/', IndexController::class)->name('index');
});


Route::middleware([
    'auth:sanctum',
])->prefix('api')->as('api:')->group(static function (): void {
    Route::get('tokens', TokensController::class)->name('tokens:index');
    Route::post('tokens', StoreTokenController::class)->name('tokens:store');
    Route::put('tokens/{tokenId}', UpdateController::class)->name('tokens:update');
    Route::delete('tokens/{tokenId}', DeleteController::class)->name('tokens:delete');
});
