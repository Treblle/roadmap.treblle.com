<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Web\Pages\HomeController;
use App\Http\Requests\Web\Profile\ConfirmPasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class DeleteProfileController
{
    public function __invoke(ConfirmPasswordRequest $request): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return new RedirectResponse(
            url: action(HomeController::class),
        );
    }
}
