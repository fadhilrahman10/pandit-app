<?php

namespace Database\Factories;

use App\Models\Standing;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Standing>
 */
class StandingFactory extends Factory
{

    protected $model = Standing::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => '',
            'points' => 0,
            'win' => 0,
            'draw' => 0,
            'lost' => 0,
            'number_of_match' => 0,
            'home_goal' => 0,
            'away_goal' => 0,
            'goal_difference' => 0
        ];
    }
}
