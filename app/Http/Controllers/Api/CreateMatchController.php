<?php

namespace App\Http\Controllers\Api;

use App\Events\MatchCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMatchRequest;
use App\Http\Resources\MatchResource;
use App\Models\Game;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CreateMatchController extends Controller
{
    public function __invoke(CreateMatchRequest $request): MatchResource
    {
        $match = $request->validated();

        $matchExists = Game::query()
            ->where('home_team_id', $match['home_team_id'])
            ->where('away_team_id', $match['away_team_id'])
            ->exists();

        if ($matchExists) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => "Match already exists"
                ]
            ], 400));
        }

//        dd(Game::query()
//            ->whereDate('schedule', Carbon::create($match['schedule']))->get());

        $isMatchEnded = Game::query()
            ->where('schedule', $match['schedule'])
            ->where(function($query) use ($request) {
                $query->where('home_team_id', $request->home_team_id)
                    ->orWhere('away_team_id', $request->home_team_id)
                    ->orWhere('home_team_id', $request->away_team_id)
                    ->orWhere('away_team_id', $request->away_team_id);
            })
            ->exists();

        if ($isMatchEnded) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => "The team has competed on " . $match['schedule']
                ]
            ], 400));
        }

        $statistic = [
            'home_team_goal' => $match['home_team_goal'],
            'away_team_goal' => $match['away_team_goal'],
        ];

        $createMatch = Game::query()->create([
            "home_team_id" => $match['home_team_id'],
            "away_team_id" => $match['away_team_id'],
            "schedule" => $match['schedule'],
        ]);

        event(new MatchCreated($createMatch, $statistic));

        return new MatchResource($createMatch);
    }
}
