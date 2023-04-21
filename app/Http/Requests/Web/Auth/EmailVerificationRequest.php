<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Http\FormRequest;

final class EmailVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        /**
         * @var User $user
         */
        $user = $this->user();

        if ( ! hash_equals(strval($user->getKey()), strval($this->route('id')))) {
            return false;
        }

        return ! ( ! hash_equals(sha1($user->email), strval($this->route('hash'))))



        ;
    }

    public function rules(): array
    {
        return [];
    }

    public function fulfill(): void
    {
        /**
         * @var User $user
         */
        $user = $this->user();

        if ( ! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified(
                user: $user,
            ));
        }
    }
}
