<?php

declare(strict_types=1);

namespace App\Commands\Auth;

use App\DataObjects\Auth\Registration;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class CreateNewUser
{
    public function handle(Registration $registration): Model|User
    {
        $user = DB::transaction(
            callback: static fn () => User::query()->create(
                attributes: $registration->toArray(),
            ),
            attempts: 2,
        );

        event(new Registered(
            user: $user,
        ));

        return $user;
    }
}
