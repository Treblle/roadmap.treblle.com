<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Ideas\ShowController;
use App\Models\Idea;
use Inertia\Testing\AssertableInertia;
use Treblle\Tools\Http\Enums\Status;

use function Pest\Laravel\get;

it('returns the correct status code if not found', function (int $id): void {
    get(
        uri: action(ShowController::class, (string) $id)
    )->assertStatus(
        status: Status::NOT_FOUND->value,
    );
})->with('numbers');

it('returns the correct status code when found', function (): void {
    $idea = Idea::factory()->create();

    get(
        uri: action(ShowController::class, $idea->getKey()),
    )->assertStatus(
        status: Status::OK->value,
    );
});

it('loads the correct Inertia component', function (): void {
    $idea = Idea::factory()->create();

    get(
        uri: action(ShowController::class, $idea->getKey()),
    )->assertInertia(
        fn (AssertableInertia $page) => $page
            ->component('Ideas/Show'),
    );
});
