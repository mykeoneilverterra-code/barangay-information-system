<?php

use App\Http\Controllers\ResidentAnnouncementController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Resident Announcement Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'web',
    'auth',
    'role:resident',
])->group(function () {


    Route::get(
        '/portal/announcements',
        [
            ResidentAnnouncementController::class,
            'index',
        ]
    )->name(
        'resident.announcements.index'
    );


});