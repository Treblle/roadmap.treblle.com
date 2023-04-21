<?php

declare(strict_types=1);

use App\DataObjects\Idea as IdeaObject;
use App\Jobs\Ideas\CreateNewJob;
use App\Models\Idea;
use App\Models\User;

beforeEach(fn () => $this->user = User::factory()->create());

it('can create a new instance', function (string $string): void {
    expect(
        new CreateNewJob(
            idea: new IdeaObject(
                name: $string,
                description: $string,
                status: \App\Enums\Status::SUBMITTED,
                category: \App\Enums\Category::API,
                user: $this->user->getKey(),
            )
        ),
    )->toBeInstanceOf(CreateNewJob::class);
})->with('strings');

it('will create a new idea', function (string $string): void {
    $job = new CreateNewJob(
        idea: new IdeaObject(
            name: $string,
            description: $string,
            status: \App\Enums\Status::SUBMITTED,
            category: \App\Enums\Category::API,
            user: $this->user->getKey(),
        )
    );

    expect(
        Idea::query()->count(),
    )->toEqual(0);

    $job->handle();

    expect(
        Idea::query()->count(),
    )->toEqual(1);
})->with('strings');
