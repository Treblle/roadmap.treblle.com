<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Manage\Api;

use Illuminate\Http\Request;

final class DeleteController
{
    public function __invoke(Request $request, string|int $tokenId): void
    {
        $request->user()?->tokens()->where('id', $tokenId)->first()?->delete();

        $request->session()->flash('message', [
            'heading' => 'API Token Destroyed',
            'contents' => 'Your API Token has now been destroyed.',
        ]);
    }
}
