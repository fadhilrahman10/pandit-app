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
        Schema::create('standings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('team_id')->unique();
            $table->integer('points');
            $table->integer('win');
            $table->integer('draw');
            $table->integer('lost');
            $table->integer('number_of_match');
            $table->integer('home_goal');
            $table->integer('away_goal');
            $table->integer('goal_difference');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standings');
    }
};
