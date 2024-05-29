<?php

namespace App\Listeners;

use App\Events\MatchCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CreatingMatchStatistic
{
    /**
     * Handle the event.
     */
    public function handle(MatchCreated $event): void
    {
        $event->match->statistics()->create([
            'home_team_goal' => $event->statistic['home_team_goal'],
            'away_team_goal' => $event->statistic['away_team_goal'],
        ]);
//        event(new MatchStatisticCreated($event->match, $statistic));
    }
}
