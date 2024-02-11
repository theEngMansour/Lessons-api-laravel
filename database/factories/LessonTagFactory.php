<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LessonTag>
 */
class LessonTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lesson_id' => $this->faker->numberBetween(1, 19),
            'tag_id' => $this->faker->numberBetween(1, 19)
        ];
    }
}
