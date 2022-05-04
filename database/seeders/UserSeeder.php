<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\UserFactory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->me()->create();


        User::factory()->admin()->create();

        User::factory()
            ->count(20)
            ->create();

        $this->command->info("usuarios creados");
    }
}
