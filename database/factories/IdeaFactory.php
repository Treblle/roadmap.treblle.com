<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Category;
use App\Enums\Status;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

final class IdeaFactory extends Factory
{
    protected $model = Idea::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => Arr::random(
                array: Status::cases(),
            ),
            'category' => Arr::random(
                array: Category::cases(),
            ),
            'votes' => $this->faker->numberBetween(
                int1: 0,
                int2: 1_000_000,
            ),
            'user_id' => User::factory(),
        ];
    }
}
