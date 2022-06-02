<?php

namespace Database\Factories;

use DateInterval;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'username' => $this->faker->unique()->userName(),
            'birthday' => date_sub(now(), new DateInterval('P20Y')),
            'role_id' => 2,
            'avatar' => 'default.png',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });


    }

    public function me()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Jesús',
                'last_name' => 'Domínguez Malvárez',
                'email' => 'megatrix12@gmail.com',
                'password' => '$2y$10$JaxRtSE/A3T52S55jj3iJO8yZ0L25CIP78ryS5237u6ER4kW0m/6S', //1
                'username' => 'jesusdoma',
                'birthday' => date_sub(now(), new DateInterval('P23Y')),
                'role_id' => 1,
                'avatar' => 'default.png'
            ];
        });
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => 1,
            ];
        });
    }
}
