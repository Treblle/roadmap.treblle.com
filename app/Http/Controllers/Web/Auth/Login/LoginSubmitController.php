<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\Login;

use App\Http\Controllers\Web\Pages\HomeController;
use App\Http\Requests\Web\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

final class LoginSubmitController
{
    /**
     * @throws ValidationException
     */
    public function __invoke(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return new RedirectResponse(
            url: action(HomeController::class),
        );
    }
}
