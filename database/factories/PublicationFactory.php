<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
{
    public function imageName()
    {
        $stringNum = strval(random_int(1,3));
        $string = 'example' . $stringNum . '.png';
        return $string;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'img' => $this->imageName(),
            'description' => $this->faker->sentence(10),
            'user_id' => random_int(2,22),
            'visible' => true
        ];
    }

    public function me()
    {
        return $this->state(function (array $attributes) {
            return [
                'img' => $this->imageName(),
                'user_id' => 1
            ];
        });
    }
}
