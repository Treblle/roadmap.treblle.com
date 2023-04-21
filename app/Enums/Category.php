<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Attributes\Description;
use App\Enums\Concerns\CanAccessAttributes;
use App\Enums\Concerns\Collected;

enum Category: string
{
    use CanAccessAttributes;
    use Collected;

    #[Description('This idea focuses on the SDKs.')]
    case SDK = 'SDK';

    #[Description('This idea focuses on Analytics.')]
    case ANALYTICS = 'ANALYTICS';

    #[Description('This idea focuses on Projects.')]
    case PROJECTS = 'PROJECTS';

    #[Description('This idea focuses on the API.')]
    case API = 'API';
}
