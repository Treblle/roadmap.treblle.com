<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class PasswordConfirmationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
