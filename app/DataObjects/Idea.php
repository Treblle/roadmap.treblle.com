<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Enums\Category;
use App\Enums\Status;

final readonly class Idea
{
    public function __construct(
        public string $name,
        public string $description,
        public Status $status,
        public Category $category,
        public string $user,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'category' => $this->category,
            'user_id' => $this->user,
        ];
    }
}
