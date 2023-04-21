<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Profile;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /**
         * @var User $user
         */
        $user = $this->user();

        return [
            'name' => [
                'string',
                'max:255',
            ],
            'email' => [
                'email',
                'max:255',
                Rule::unique(
                    table: 'users',
                    column: 'email',
                )->ignore(
                    id: $user->id,
                ),
            ],
        ];
    }
}
