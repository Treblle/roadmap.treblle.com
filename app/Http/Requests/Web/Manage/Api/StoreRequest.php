<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Manage\Api;

use App\DataObjects\Token;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

final class StoreRequest extends FormRequest
{
    public string $plainTextToken;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'permissions' => [
                'required',
                'array',
                'min:1'
            ],
        ];
    }

    public function payload(): Token
    {
        $this->plainTextToken = Str::random(40);

        return new Token(
            name: $this->string('name')->toString(),
            abilities: (array) $this->get('permissions'),
            token: hash('sha256', $this->plainTextToken),
        );
    }
}
