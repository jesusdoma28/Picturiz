<?php

namespace Database\Seeders;

use App\Models\Follower;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class FollowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Follower::factory()
            ->count(3)
            ->state(new Sequence(
                ['account_id' => '2', 'follower_id' => '1'],
                ['account_id' => '3', 'follower_id' => '1'],
                ['account_id' => '2', 'follower_id' => '4'],
            ))
            ->create();
        Follower::factory()->me_seguidos()->count(5)->create();
        Follower::factory()->me_followers()->count(5)->create();


    }
}
