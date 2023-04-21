<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Attributes\Description;
use App\Enums\Concerns\CanAccessAttributes;
use App\Enums\Concerns\Collected;

enum Role: string
{
    use CanAccessAttributes;
    use Collected;

    #[Description('Internal Engineer')]
    case ENGINEER = 'ENGINEER';

    #[Description('External User')]
    case USER = 'USER';
}
