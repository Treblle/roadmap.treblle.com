<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Pages;

use App\Http\Resources\Web\IdeaResource;
use App\Queries\FetchIdeas;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final readonly class HomeController
{
    public function __construct(
        private FetchIdeas $query,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return Inertia::render(
            component: 'Static/Home',
            props: [
                'ideas' => fn () => IdeaResource::collection(
                    resource: $this->query->handle(
                        filters: ['category', 'status', 'user.id'],
                    )->with(['user'])->get(),
                ),
            ],
        );
    }
}
