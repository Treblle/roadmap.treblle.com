<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Attributes\Description;

enum EventMap: string
{
    #[Description('This event is fired when a new Idea is created.')]
    case IDEA_CREATED = 'idea-created';

    #[Description('This event is fired when a user creates a new API Token.')]
    case TOKEN_CREATED = 'token-created';

    #[Description('This event is fired when a user votes on an idea.')]
    case USER_VOTED = 'user-voted';
}
