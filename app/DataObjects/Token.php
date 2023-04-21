<?php

declare(strict_types=1);

namespace App\DataObjects;

final readonly class Token
{
    public function __construct(
        public string $name,
        public array $abilities,
        public string $token,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'abilities' => $this->abilities,
            'token' => $this->token,
        ];
    }
}
