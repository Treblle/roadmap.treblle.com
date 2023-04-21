<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Ideas;

use App\DataObjects\Idea;
use App\Enums\Category;
use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreRequest extends FormRequest
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
                'string',
                'min:2',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
            ],
            'category' => [
                'required',
                Rule::enum(
                    type: Category::class,
                ),
            ],
        ];
    }

    public function payload(string $user): Idea
    {
        return new Idea(
            name: $this->string('name')->toString(),
            description: $this->string('description')->toString(),
            status: Status::SUBMITTED,
            category: Category::from(
                value: $this->string('category')->toString(),
            ),
            user: $user,
        );
    }
}
