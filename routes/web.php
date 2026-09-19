<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get(
    '/dashboard',
    [DashboardController::class, 'index']
)->name('dashboard');


/*
|--------------------------------------------------------------------------
| Residents
|--------------------------------------------------------------------------
*/

Route::resource(
    'residents',
    ResidentController::class
);