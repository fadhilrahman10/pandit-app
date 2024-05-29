<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Standing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetAllStandingController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $standings = Standing::with('team')
            ->orderBy('points', 'desc')
            ->orderByRaw('(home_goal - away_goal) DESC')
            ->orderBy('away_goal', 'desc')
            ->orderBy('number_of_match', 'asc')
            ->get();

        $rankedStandings = collect($standings)->map(function ($standing, $index) {
            return [
                "id" => $standing->id,
                "name" => $standing->team->name,
                "city" => $standing->team->city,
                "rank" => $index + 1,
                "points" => $standing->points,
                "win" => $standing->win,
                "lost" => $standing->lost,
                "draw" => $standing->draw,
                "number_of_match" => $standing->number_of_match,
                "home_goal" => $standing->home_goal,
                "away_goal" => $standing->away_goal
            ];
        });

        return response()->json([
            "data" => $rankedStandings
        ]);
    }
}
