<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Auth;

use App\DataObjects\Auth\PasswordReset;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

final class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
        ];
    }

    public function payload(): PasswordReset
    {
        return new PasswordReset(
            email: $this->string('email')->toString(),
            password: $this->string('password')->toString(),
            passwordConfirmation: $this->string('password_confirmation')->toString(),
            token: $this->string('token')->toString(),
        );
    }
}
