<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Profile;

use Illuminate\Foundation\Http\FormRequest;

final class ConfirmPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => [
                'required',
                'current_password',
            ],
        ];
    }
}
