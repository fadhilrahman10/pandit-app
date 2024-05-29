<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Standing;
use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Database\Factories\StandingFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Team::factory(4)->create();

        $teams = Team::all();

        foreach ($teams as $team) {
            Standing::factory()->create(['team_id' => $team->id]);
        }
    }
}
