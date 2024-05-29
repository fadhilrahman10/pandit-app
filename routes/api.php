<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/standings', \App\Http\Controllers\Api\GetAllStandingController::class);

Route::post('/match', \App\Http\Controllers\Api\CreateMatchController::class);
