<?php

declare(strict_types=1);

namespace App\DataObjects\Auth;

final readonly class Registration
{
    public function __construct(
        private string $name,
        private string $email,
        private string $password,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
