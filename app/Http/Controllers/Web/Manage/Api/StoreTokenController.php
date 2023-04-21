<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Manage\Api;

use App\Aggregates\TokenAggregateRoot;
use App\Http\Requests\Web\Manage\Api\StoreRequest;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

final readonly class StoreTokenController
{
    public function __construct(
        private Authenticatable $user,
    ) {
    }

    public function __invoke(StoreRequest $request): RedirectResponse
    {
        TokenAggregateRoot::retrieve(
            uuid: Str::uuid()->toString(),
        )->createToken(
            token: $request->payload(),
            user: strval($this->user->getAuthIdentifier()),
        )->persist();

        /**
         * @var PersonalAccessToken $token
         */
        $token = PersonalAccessToken::query()
            ->latest()
            ->where('name', $request->string('name')->toString())
            ->first();

        $request->session()->flash('message', [
            'heading' => 'API Token Created',
            'contents' => $request->plainTextToken,
        ]);

        return (new RedirectResponse(
            url: action(TokensController::class),
        ));
    }
}
