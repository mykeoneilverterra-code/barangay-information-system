<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| System Extension Routes
|--------------------------------------------------------------------------
*/

Route::middleware('web')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | ADMIN — REPORTS
    |--------------------------------------------------------------------------
    */

    Route::middleware([
        'auth',
        'role:admin',
    ])->group(function () {


        Route::get(
            '/reports',
            [
                ReportController::class,
                'index',
            ]
        )->name(
            'reports.index'
        );


        Route::get(
            '/reports/print',
            [
                ReportController::class,
                'print',
            ]
        )->name(
            'reports.print'
        );


        Route::get(
            '/reports/export',
            [
                ReportController::class,
                'export',
            ]
        )->name(
            'reports.export'
        );


    });


});