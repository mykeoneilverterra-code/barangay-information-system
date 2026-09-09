<?php

use App\Models\Household;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\ResidentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('households', HouseholdController::class);

Route::resource('residents', ResidentController::class);
