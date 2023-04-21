<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\Category;
use App\Enums\Role;
use App\Enums\Status;
use App\Http\Resources\Web\UserResource;
use App\Services\Reporting\RoadmapReports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

final class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function __construct(
        private readonly RoadmapReports $reports,
    ) {
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => Auth::check() ? new UserResource(
                    resource: $request->user(),
                ) : null,
            ],
            'categories' => Category::collect(),
            'statuses' => Status::collect(),
            'roles' => Role::collect(),
            'filter' => array_map(
                callback: fn ($filter) => [$filter],
                array: (array) $request->get('filter'),
            ),
            'reports' => [
                'ideas-created' => $this->reports->ideasCreated(),
                'users-voted' => $this->reports->votes(),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy())->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
        ]);
    }
}
