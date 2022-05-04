<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'text' => $this->faker->text(100),
            'publication_id' => random_int(1,43),
            'user_id' => random_int(1,22)
        ];
    }

    public function me()
    {
        return $this->state(function (array $attributes) {
            return [
                'publication_id' => random_int(1,3),
                'user_id' => random_int(2,22)
            ];
        });
    }
}
