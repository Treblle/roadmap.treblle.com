<?php

declare(strict_types=1);

namespace App\Exceptions\Ideas;

use InvalidArgumentException;

final class AlreadyVoted extends InvalidArgumentException
{
}
