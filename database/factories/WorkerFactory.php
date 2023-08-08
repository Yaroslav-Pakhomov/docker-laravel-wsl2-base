<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Position;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Worker>
 */
class WorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => fake()->firstName(),
            'surname'     => fake()->lastName(),
            'email'       => fake()->unique()->safeEmail(),
            'age'         => fake()->numberBetween(18, 60),
            'description' => fake()->paragraphs(2, true),
            'is_married'  => fake()->boolean(),
            'position_id' => Position::query()->inRandomOrder()->first()->id,
        ];
    }
}
