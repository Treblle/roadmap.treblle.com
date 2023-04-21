<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', fn (Request $request) => $request->user());

/**
 * Route::prefix('ideas')->as('ideas:')->group(static function (): void {
 *  Route::get('/', IndexController::class)->name('index');
 *  Route::post('/', StoreController::class)->name('store');
 *  Route::get('{ulid}', ShowController::class)->name('show');
 *  Route::put('{ulid}', UpdateController::class)->name('update');
 *  Route::delete('{ulid}', DeleteController::class)->name('delete');
 *
 *  Route::put('{ulid}/vote', VoteController::class)->name('vote');
 * });
 */
