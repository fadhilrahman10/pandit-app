<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function homeMatches(): HasMany
    {
        return $this->hasMany(Game::class, 'home_team_id');
    }

    public function awayMatches(): HasMany
    {
        return $this->hasMany(Game::class, 'away_team_id');
    }

    public function standings(): HasOne
    {
        return $this->hasOne(Standing::class, 'team_id');
    }
}
