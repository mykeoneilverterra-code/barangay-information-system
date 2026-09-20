<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\ResidentAuthController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ResidentDocumentRequestController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect()
        ->route('dashboard');

});


/*
|--------------------------------------------------------------------------
| ADMIN — DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get(
    '/dashboard',
    [DashboardController::class, 'index']
)->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN — RESIDENTS
|--------------------------------------------------------------------------
*/

Route::resource(
    'residents',
    ResidentController::class
);


/*
|--------------------------------------------------------------------------
| ADMIN — DOCUMENT REQUESTS
|--------------------------------------------------------------------------
|
| Temporary:
| Create/Store are still available on Admin side.
|
| Later in Step 6:
| Admin will become processing-only.
|
*/

Route::resource(
    'document-requests',
    DocumentRequestController::class
);


/*
|--------------------------------------------------------------------------
| RESIDENT — LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get(
        '/resident/login',
        [ResidentAuthController::class, 'showLogin']
    )->name('resident.login');


    Route::post(
        '/resident/login',
        [ResidentAuthController::class, 'login']
    )->name('resident.login.submit');

});


/*
|--------------------------------------------------------------------------
| RESIDENT — AUTHENTICATED PORTAL
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Resident Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/portal', function () {

        $user = auth()->user();


        abort_unless(
            $user
            && $user->role === 'resident'
            && $user->resident_id
            && $user->resident,
            403
        );


        return view(
            'resident_portal.dashboard'
        );

    })->name('resident.portal');


    /*
    |--------------------------------------------------------------------------
    | Request Document
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/portal/request-document',
        [ResidentDocumentRequestController::class, 'create']
    )->name('resident.requests.create');


    Route::post(
        '/portal/request-document',
        [ResidentDocumentRequestController::class, 'store']
    )->name('resident.requests.store');


    /*
    |--------------------------------------------------------------------------
    | Resident Logout
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/resident/logout',
        [ResidentAuthController::class, 'logout']
    )->name('resident.logout');

});