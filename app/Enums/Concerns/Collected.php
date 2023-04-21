<?php

declare(strict_types=1);

namespace App\Enums\Concerns;

use BackedEnum;

trait Collected
{
    public static function collect(): array
    {
        return collect(static::cases())->map(fn (BackedEnum $enum): array => [
            'name' => $enum->name,
            'value' => $enum->value,
            /** @phpstan-ignore-next-line  */
            'description' => $enum::description($enum),
        ])->toArray();
    }
}
