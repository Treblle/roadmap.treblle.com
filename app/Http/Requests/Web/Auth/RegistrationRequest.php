<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Auth;

use App\DataObjects\Auth\Registration;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

final class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string|6',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(
                    table: 'users',
                    column: 'email',
                ),
            ],
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
        ];
    }

    public function payload(): Registration
    {
        return new Registration(
            name: $this->string('name')->toString(),
            email: $this->string('email')->toString(),
            password: Hash::make(
                value: $this->string('password')->toString(),
            ),
        );
    }
}
