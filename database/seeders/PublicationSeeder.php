<?php

namespace Database\Seeders;

use App\Models\Publication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publication::factory()->me()->count(3)->create();

        Publication::factory()->count(12)
        ->state(new Sequence(
            ['user_id' => '2'],
            ['user_id' => '3'],
        ))
        ->create();

        Publication::factory()
            ->count(40)
            ->create();
    }
}
