<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Profile\DeleteProfileController;
use App\Http\Controllers\Web\Profile\EditSubmitController;
use App\Http\Controllers\Web\Profile\EditViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', EditViewController::class)->name('edit');
Route::patch('/', EditSubmitController::class)->name('update');
Route::delete('/', DeleteProfileController::class)->name('destroy');
