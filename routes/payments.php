<?php

use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\PrintableDocumentController;
use App\Http\Controllers\ResidentPaymentController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Payment Routes
|--------------------------------------------------------------------------
|
| Kept separate from routes/web.php so the existing working routing
| structure does not need to be modified.
|
*/

Route::middleware('web')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware([
        'auth',
        'role:admin',
    ])->group(function () {


        Route::get(
            '/document-requests/{documentRequest}/payment/proof',
            [
                AdminPaymentController::class,
                'proof',
            ]
        )->name(
            'admin.payments.proof'
        );


        Route::post(
            '/document-requests/{documentRequest}/payment/verify-gcash',
            [
                AdminPaymentController::class,
                'verifyGcash',
            ]
        )->name(
            'admin.payments.verify-gcash'
        );


        Route::post(
            '/document-requests/{documentRequest}/payment/reject-gcash',
            [
                AdminPaymentController::class,
                'rejectGcash',
            ]
        )->name(
            'admin.payments.reject-gcash'
        );


        Route::post(
            '/document-requests/{documentRequest}/payment/mark-cash-paid',
            [
                AdminPaymentController::class,
                'markCashPaid',
            ]
        )->name(
            'admin.payments.mark-cash-paid'
        );


        Route::get(
            '/document-requests/{documentRequest}/print',
            [
                PrintableDocumentController::class,
                'show',
            ]
        )->name(
            'document-requests.print'
        );

    });


    /*
    |--------------------------------------------------------------------------
    | RESIDENT
    |--------------------------------------------------------------------------
    */

    Route::middleware([
        'auth',
        'role:resident',
    ])->group(function () {


        Route::get(
            '/portal/my-requests/{documentRequest}/payment',
            [
                ResidentPaymentController::class,
                'choose',
            ]
        )->name(
            'resident.payments.choose'
        );


        Route::post(
            '/portal/my-requests/{documentRequest}/payment/method',
            [
                ResidentPaymentController::class,
                'selectMethod',
            ]
        )->name(
            'resident.payments.method'
        );


        Route::post(
            '/portal/my-requests/{documentRequest}/payment/gcash',
            [
                ResidentPaymentController::class,
                'submitGcash',
            ]
        )->name(
            'resident.payments.gcash.submit'
        );


        Route::get(
            '/portal/my-requests/{documentRequest}/payment/proof',
            [
                ResidentPaymentController::class,
                'proof',
            ]
        )->name(
            'resident.payments.proof'
        );

    });

});