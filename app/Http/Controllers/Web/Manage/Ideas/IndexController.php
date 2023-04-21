<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Manage\Ideas;

use App\Http\Resources\Web\IdeaResource;
use App\Queries\FetchIdeas;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final readonly class IndexController
{
    public function __construct(
        private Authenticatable $user,
        private FetchIdeas $query,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return Inertia::render(
            component: 'Manage/Ideas/Index',
            props: [
                'ideas' => IdeaResource::collection(
                    resource: $this->query->handle()->where(
                        'user_id',
                        $this->user->getAuthIdentifier(),
                    )->get(),
                ),
            ],
        );
    }
}
