<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
            ],
            'password' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if ( ! Auth::attempt($this->only('email', 'password'))) {
            RateLimiter::hit(
                key: $this->throttleKey(),
            );

            throw ValidationException::withMessages(
                messages: [
                    'email' => trans('auth.failed'),
                ],
            );
        }

        RateLimiter::clear(
            key: $this->throttleKey(),
        );
    }

    /**
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if ( ! RateLimiter::tooManyAttempts(key: $this->throttleKey(), maxAttempts: 5)) {
            return;
        }

        event(new Lockout(
            request: $this,
        ));

        $seconds = RateLimiter::availableIn(
            key: $this->throttleKey(),
        );

        throw ValidationException::withMessages(
            messages: [
                'email' => trans(
                    'auth.throttle',
                    [
                        'seconds' => $seconds,
                        'minutes' => ceil($seconds / 60),
                    ],
                ),
            ]
        );
    }

    public function throttleKey(): string
    {
        return Str::transliterate(
            string: Str::lower(
                value: $this->string('email')->toString(),
            ).'|'.$this->ip(),
        );
    }
}
