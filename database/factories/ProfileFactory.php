<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Profile;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $workers = Worker::all();

        // Навыки
        $arrSkills = ['JavaScript', 'PHP', 'HTML', 'CSS', 'Python', 'Java', 'C++', 'C#',];
        $counter = rand(2, 5);
        $skills = [];
        for ($i = 0; $i <= $counter; $i++) {
            $number = rand(0, 7);
            $skills[] = $arrSkills[$number];
        }
        $skills = array_unique($skills);

        return [
            'city'              => fake()->city(),
            'skill'             => implode(', ', $skills),
            'experience'        => fake()->numberBetween(2, 5),
            'finished_study_at' => fake()->dateTimeInInterval('-10 years ago', '-3 years ago'),
            'worker_id'         => Worker::factory()->create(),
            // 'worker_id'         => fake()->unique()->numberBetween(1, $workers->count()),
        ];
    }
}
