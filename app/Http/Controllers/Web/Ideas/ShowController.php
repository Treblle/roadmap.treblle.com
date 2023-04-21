<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Ideas;

use App\Http\Resources\Web\IdeaResource;
use App\Queries\FetchIdeas;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class ShowController
{
    public function __construct(
        private readonly FetchIdeas $query,
    ) {
    }

    public function __invoke(Request $request, string $ulid): Response
    {
        return Inertia::render(
            component: 'Ideas/Show',
            props: [
                'idea' => fn () => new IdeaResource(
                    resource: $this->query->handle()->with([
                        'user',
                        'votes',
                    ])->findOrFail(
                        id: $ulid,
                    ),
                ),
            ],
        );
    }
}
