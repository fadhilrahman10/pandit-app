<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "home_team_id" => $this['home_team_id'],
            "away_team_id" => $this['away_team_id'],
            "schedule" => $this['schedule'],
        ];
    }
}
