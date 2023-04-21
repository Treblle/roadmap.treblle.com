<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Ideas\CreateController;

use App\Models\User;
use Inertia\Testing\AssertableInertia;
use Treblle\Tools\Http\Enums\Status;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('redirects a user if not authenticated', function (): void {
    get(
        uri: action(CreateController::class),
    )->assertRedirect(
        uri: route('login'),
    );
});

it('returns the correct status code if the user is authenticated', function (): void {
    actingAs(User::factory()->create())->get(
        uri: action(CreateController::class),
    )->assertStatus(
        status: Status::OK->value,
    );
});

it('loads the correct Inertia component', function (): void {
    actingAs(User::factory()->create())->get(
        uri: action(CreateController::class),
    )->assertInertia(
        fn (AssertableInertia $page) => $page
            ->component('Ideas/Create'),
    );
});
