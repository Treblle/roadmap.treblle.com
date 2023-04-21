<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\Password;

use App\Commands\Auth\UpdateUserPassword;
use App\Http\Requests\Web\Auth\UpdatePasswordRequest;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

final readonly class UpdatePasswordController
{
    public function __construct(
        private UpdateUserPassword $command,
        private Authenticatable $user,
    ) {
    }

    public function __invoke(UpdatePasswordRequest $request): RedirectResponse
    {
        $this->command->handle(
            user: strval($this->user->getAuthIdentifier()),
            password: Hash::make(
                value: $request->string('password')->toString(),
            ),
        );

        $request->session()->flash('message', [
            'heading' => 'Password Updated',
            'message' => 'You have updated your password.',
        ]);

        return redirect()->back();
    }
}
