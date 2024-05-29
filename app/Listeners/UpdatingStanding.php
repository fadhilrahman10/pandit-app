<?php

namespace App\Listeners;

use App\Events\MatchCreated;
use App\Models\Standing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdatingStanding
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MatchCreated $event): void
    {
        Log::info("TEST");
        $homeId = $event->match->home_team_id;
        $awayId = $event->match->away_team_id;
        $awayGoal = $event->statistic['away_team_goal'];
        $homeGoal = $event->statistic['home_team_goal'];

        $this->updateStandings($homeId, $homeGoal, $awayGoal);
        $this->updateStandings($awayId, $awayGoal, $homeGoal);
    }

    private function updateStandings(string $teamId, int $homeGoal, int $awayGoal): void
    {
        $standing = Standing::where('team_id', $teamId)->first();

        $standing->number_of_match += 1;
        $standing->home_goal += $homeGoal;
        $standing->away_goal += $awayGoal;

        Log::info("STANDING $teamId $homeGoal $awayGoal");

        if ($homeGoal > $awayGoal) {
            $standing->win += 1;
            $standing->points += 3;
        } elseif ($homeGoal < $awayGoal) {
            $standing->lost += 1;
        } else {
            $standing->draw += 1;
            $standing->points += 1;
        }

        $standing->goal_difference = $homeGoal - $awayGoal;

        $standing->save();

        Log::info("STANDING UPDATED", [
            $standing
        ]);
    }
}
