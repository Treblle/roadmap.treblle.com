<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Pages\HomeController;
use App\Models\User;
use Inertia\Testing\AssertableInertia;
use Treblle\Tools\Http\Enums\Status;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('allows you to visit as a guest', function (): void {
    get(
        uri: action(HomeController::class),
    )->assertStatus(
        status: Status::OK->value,
    );
});

it('allows you to visit as an authenticated user', function (): void {
    actingAs(User::factory()->create())->get(
        uri: action(HomeController::class),
    )->assertStatus(
        status: Status::OK->value,
    );
});

it('loads the correct Inertia page', function (): void {
    get(
        uri: action(HomeController::class),
    )->assertInertia(
        fn (AssertableInertia $page) => $page
            ->component('Static/Home'),
    );
});
