<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Attributes\Description;
use App\Enums\Concerns\CanAccessAttributes;
use App\Enums\Concerns\Collected;

enum Status: string
{
    use CanAccessAttributes;
    use Collected;

    #[Description('Idea has been submitted.')]
    case SUBMITTED = 'SUBMITTED';

    #[Description('Idea is under review.')]
    case UNDER_REVIEW = 'UNDER REVIEW';

    #[Description('Idea is currently in progress.')]
    case IN_PROGRESS = 'IN PROGRESS';

    #[Description('Idea is now live.')]
    case LIVE = 'LIVE';
}
