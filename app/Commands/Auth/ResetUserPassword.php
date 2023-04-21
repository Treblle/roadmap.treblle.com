<?php

declare(strict_types=1);

namespace App\Commands\Auth;

use App\DataObjects\Auth\PasswordReset;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset as PasswordResetEvent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

final class ResetUserPassword
{
    public function handle(PasswordReset $passwordReset): mixed
    {
        return Password::reset(
            credentials: $passwordReset->toArray(),
            callback: static function (User $user) use ($passwordReset): void {
                $user->update([
                    'password' => Hash::make(
                        value: $passwordReset->password,
                    ),
                    'remember_token' => Str::random(
                        length: 60,
                    ),
                ]);

                event(new PasswordResetEvent(
                    user: $user,
                ));
            }
        );
    }
}
