<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Attributes\Abilities;
use App\Enums\Attributes\Description;
use App\Enums\Attributes\Key;
use App\Enums\Concerns\CanAccessAttributes;
use App\Enums\Concerns\Collected;

enum Permission: string
{
    use CanAccessAttributes;
    use Collected;

    #[Key('admin')]
    #[Description('Admin users can perform any action.')]
    #[Abilities(['create','read','update','delete'])]
    case ADMIN = 'ADMIN';

    #[Key('editor')]
    #[Description('Editor users have the ability to read, and update.')]
    #[Abilities(['read','update'])]
    case EDITOR = 'EDITOR';
}
