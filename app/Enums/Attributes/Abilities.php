<?php

declare(strict_types=1);

namespace App\Enums\Attributes;

use Attribute;

#[Attribute]
final readonly class Abilities
{
    public function __construct(
        public array $abilities,
    ) {
    }
}
