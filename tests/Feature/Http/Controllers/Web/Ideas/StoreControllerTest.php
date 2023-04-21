<?php

declare(strict_types=1);

use App\Enums\Category;
use App\Http\Controllers\Web\Ideas\StoreController;
use App\Jobs\Ideas\CreateNewJob;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Support\Facades\Bus;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

it('redirects if the user is not authenticated', function (): void {
    post(
        uri: action(StoreController::class),
    )->assertRedirect(
        uri: route('login'),
    );
});

it('returns a redirect if validation fails', function (): void {
    actingAs(User::factory()->create())->post(
        uri: action(StoreController::class),
        data: [],
    )->assertRedirect()->assertSessionHasErrors(
        keys: ['name', 'description', 'category'],
    );
});

it('will dispatch a job to create the Idea', function (string $string): void {
    Bus::fake();

    actingAs(User::factory()->create())->post(
        uri: action(StoreController::class),
        data: [
            'name' => $string,
            'description' => $string,
            'category' => Category::SDK->value,
        ],
    )->assertSessionHasNoErrors();

    Bus::assertDispatched(CreateNewJob::class);
})->with('strings');

it('will create the idea in the database', function (string $string): void {
    expect(
        Idea::query()->count(),
    )->toEqual(0);

    actingAs(User::factory()->create())->post(
        uri: action(StoreController::class),
        data: [
            'name' => $string,
            'description' => $string,
            'category' => Category::SDK->value,
        ],
    )->assertSessionHasNoErrors();

    expect(
        Idea::query()->count(),
    )->toEqual(1);
})->with('strings');
