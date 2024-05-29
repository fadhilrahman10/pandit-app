<?php

namespace App\Providers;

use App\Events\MatchCreated;
use App\Events\MatchStatisticCreated;
use App\Listeners\CreatingMatchStatistic;
use App\Listeners\CreatingStanding;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
