<?php

declare(strict_types=1);

namespace App\Http\Policies;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policies\Policy;

final class Basic extends Policy
{
    public function configure(): void
    {
        $this
            ->addDirective(
                directive: Directive::BASE,
                values: Keyword::SELF,
            )->addDirective(
                directive: Directive::CONNECT,
                values: Keyword::SELF,
            )->addDirective(
                directive: Directive::DEFAULT,
                values: Keyword::SELF,
            )->addDirective(
                directive: Directive::FORM_ACTION,
                values: Keyword::SELF,
            )->addDirective(
                directive: Directive::SCRIPT,
                values: Keyword::SELF,
            )->addDirective(
                directive: Directive::STYLE,
                values: Keyword::SELF,
            )->addDirective(
                directive: Directive::STYLE,
                values: 'fonts.bunny.net',
            )->addNonceForDirective(
                directive: Directive::SCRIPT,
            )->addNonceForDirective(
                directive: Directive::STYLE,
            );
    }
}
