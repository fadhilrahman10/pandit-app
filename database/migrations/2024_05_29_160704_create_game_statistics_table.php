<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_statistics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('game_id');
            $table->integer('home_team_goal');
            $table->integer('away_team_goal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_statistics');
    }
};
