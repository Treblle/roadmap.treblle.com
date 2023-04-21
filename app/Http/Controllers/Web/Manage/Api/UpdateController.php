<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Manage\Api;

use App\Commands\Tokens\UpdateApiToken;
use App\Http\Requests\Web\Manage\Api\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Throwable;

final class UpdateController
{
    public function __construct(
        private readonly UpdateApiToken $command,
    ) {
    }

    public function __invoke(UpdateRequest $request, string $tokenId): null|RedirectResponse
    {
        try {
            $this->command->handle(
                token: $tokenId,
                abilities: (array) $request->get('permissions'),
            );

        } catch (Throwable $exception) {
            $request->session()->flash('message', [
                'heading' => 'API Token Updated',
                'contents' => $exception->getMessage(),
            ]);

            return null;
        }

        $request->session()->flash('message', [
            'heading' => 'API Token Updated',
            'contents' => 'Permission for token have been updated',
        ]);

        return new RedirectResponse(
            url: action(TokensController::class),
        );
    }
}
