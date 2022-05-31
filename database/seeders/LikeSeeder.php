<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Publication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $publi1 = Publication::where('user_id', 2)->get()->first()->id;
        $publi2 = Publication::where('user_id', 3)->get()->first()->id;

        Like::factory()
        ->count(15)
        ->state(new Sequence(
            ['publication_id' => $publi1],
            ['publication_id' => $publi2],
        ))
        ->create();
    }
}
