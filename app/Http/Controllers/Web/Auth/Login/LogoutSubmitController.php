<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\Login;

use App\Http\Controllers\Web\Pages\HomeController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class LogoutSubmitController
{
    public function __invoke(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return new RedirectResponse(
            url: action(HomeController::class),
        );
    }
}
