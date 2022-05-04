<?php

namespace Database\Seeders;

use App\Models\Publication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        Publication::factory()
            ->count(40)
            ->create();
    }
}
