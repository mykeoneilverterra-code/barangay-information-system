<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\ResidentAuthController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ResidentDocumentRequestController;
use App\Http\Controllers\ResidentProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (!auth()->check()) {

        return redirect()
            ->route('admin.login');
    }


    if (
        auth()->user()->role
        ===
        'resident'
    ) {

        return redirect()
            ->route('resident.portal');
    }


    return redirect()
        ->route('dashboard');

});


/*
|--------------------------------------------------------------------------
| DEFAULT LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {

    return redirect()
        ->route('admin.login');

})->name('login');


/*
|--------------------------------------------------------------------------
| GUEST LOGIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Admin Login
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/login',
        [AdminAuthController::class, 'showLogin']
    )->name('admin.login');


    Route::post(
        '/admin/login',
        [AdminAuthController::class, 'login']
    )->name('admin.login.submit');


    /*
    |--------------------------------------------------------------------------
    | Resident Login
    |--------------------------------------------------------------------------
    */

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
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:admin',
])->group(function () {


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


    /*
    |--------------------------------------------------------------------------
    | Document Requests — Processing Only
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'document-requests',
        DocumentRequestController::class
    )
    ->only([
        'index',
        'show',
        'edit',
        'update',
    ]);


    /*
    |--------------------------------------------------------------------------
    | Admin Logout
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/admin/logout',
        [AdminAuthController::class, 'logout']
    )->name('admin.logout');

});


/*
|--------------------------------------------------------------------------
| RESIDENT PORTAL
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:resident',
])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Resident Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/portal', function () {

        $user = auth()->user();


        abort_unless(
            $user->resident_id
            && $user->resident,
            403
        );


        return view(
            'resident_portal.dashboard'
        );

    })->name('resident.portal');


    /*
    |--------------------------------------------------------------------------
    | My Profile
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/portal/profile',
        [ResidentProfileController::class, 'show']
    )->name('resident.profile');


    /*
    |--------------------------------------------------------------------------
    | My Requests
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/portal/my-requests',
        [ResidentDocumentRequestController::class, 'index']
    )->name('resident.requests.index');


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
    | Request Details
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/portal/my-requests/{documentRequest}',
        [ResidentDocumentRequestController::class, 'show']
    )->name('resident.requests.show');


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