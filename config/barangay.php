<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Document Fees
    |--------------------------------------------------------------------------
    |
    | DEMO VALUES ONLY for the school project.
    | Replace these later if your barangay provides actual approved rates.
    |
    */

    'document_fees' => [

        'Barangay Clearance' => 50.00,

        'Certificate of Residency' => 50.00,

        'Certificate of Indigency' => 0.00,

    ],


    /*
    |--------------------------------------------------------------------------
    | GCash Information
    |--------------------------------------------------------------------------
    */

    'gcash' => [

        'account_name' => env(
            'BARANGAY_GCASH_NAME',
            'Barangay San Antonio'
        ),

        'account_number' => env(
            'BARANGAY_GCASH_NUMBER',
            'GCash number not configured'
        ),

        'qr_path' => 'images/payments/gcash-qr.png',

    ],


    /*
    |--------------------------------------------------------------------------
    | Barangay Document Header
    |--------------------------------------------------------------------------
    */

    'office' => [

        'country' => 'Republic of the Philippines',

        'province' => 'Province of Laguna',

        'city' => 'City of Biñan',

        'barangay' => 'Barangay San Antonio',

        'signatory_name' => '____________________________',

        'signatory_position' => 'Punong Barangay',

    ],

];