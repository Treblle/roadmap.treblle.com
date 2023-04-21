<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Pages\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
