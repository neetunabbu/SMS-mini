<?php

namespace Database\Factories;

use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'user_id' => 1, // or the logged-in user id
            'class_id' => SchoolClass::inRandomOrder()->first()?->id ?? 1,
            'roll_number' => $this->faker->unique()->numerify('ROLL###'),
            'teacher_id' => Teacher::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
