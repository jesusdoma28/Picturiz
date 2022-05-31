<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FollowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public function me_seguidos()
    {
        return $this->state(function (array $attributes) {
            return [
                'account_Id' => random_int(4,22),
                'follower_id' => 1
            ];
        });
    }

    public function me_followers()
    {
        return $this->state(function (array $attributes) {
            return [
                'account_Id' => 1,
                'follower_id' => random_int(2,22)
            ];
        });
    }
}
