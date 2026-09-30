<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | View Payment Proof
    |--------------------------------------------------------------------------
    */

    public function proof(
        DocumentRequest $documentRequest
    ) {

        abort_unless(
            $documentRequest->payment_proof_path,
            404
        );


        abort_unless(
            Storage::disk('local')->exists(
                $documentRequest->payment_proof_path
            ),
            404
        );


        return Storage::disk('local')
            ->response(
                $documentRequest
                    ->payment_proof_path
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Verify GCash
    |--------------------------------------------------------------------------
    */

    public function verifyGcash(
        DocumentRequest $documentRequest
    ) {

        if (
            !$documentRequest->payment_required
        ) {

            return back()
                ->with(
                    'error',
                    'Payment is not required for this request.'
                );

        }


        if (
            $documentRequest->payment_method
            !== 'GCash'
        ) {

            return back()
                ->with(
                    'error',
                    'This request is not using GCash.'
                );

        }


        if (
            $documentRequest->payment_status
            !== 'Pending Verification'
        ) {

            return back()
                ->with(
                    'error',
                    'There is no pending GCash payment to verify.'
                );

        }


        $documentRequest->update([

            'payment_status' =>
                'Paid',

            'payment_admin_remarks' =>
                null,

            'payment_verified_at' =>
                now('Asia/Manila'),

        ]);


        return back()
            ->with(
                'success',
                'GCash payment verified successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Reject GCash
    |--------------------------------------------------------------------------
    */

    public function rejectGcash(
        Request $request,
        DocumentRequest $documentRequest
    ) {

        if (
            $documentRequest->payment_method
            !== 'GCash'
        ) {

            return back()
                ->with(
                    'error',
                    'This request is not using GCash.'
                );

        }


        if (
            $documentRequest->payment_status
            !== 'Pending Verification'
        ) {

            return back()
                ->with(
                    'error',
                    'There is no pending GCash payment to reject.'
                );

        }


        $validated =
            $request->validate([

                'payment_admin_remarks' => [
                    'required',
                    'string',
                    'max:500',
                ],

            ], [

                'payment_admin_remarks.required' =>
                    'Please provide the reason for rejecting the payment.',

            ]);


        $documentRequest->update([

            'payment_status' =>
                'Rejected',

            'payment_admin_remarks' =>
                $validated[
                    'payment_admin_remarks'
                ],

            'payment_verified_at' =>
                null,

        ]);


        return back()
            ->with(
                'success',
                'GCash payment was rejected. The resident may submit another payment proof.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Mark Cash Payment Paid
    |--------------------------------------------------------------------------
    */

    public function markCashPaid(
        DocumentRequest $documentRequest
    ) {

        if (
            !$documentRequest->payment_required
        ) {

            return back()
                ->with(
                    'error',
                    'This request does not require payment.'
                );

        }


        if (
            $documentRequest->payment_method
            !== 'Cash'
        ) {

            return back()
                ->with(
                    'error',
                    'The resident did not select payment at the Barangay Hall.'
                );

        }


        if (
            $documentRequest->payment_status
            === 'Paid'
        ) {

            return back()
                ->with(
                    'error',
                    'This payment is already marked as paid.'
                );

        }


        $documentRequest->update([

            'payment_status' =>
                'Paid',

            'payment_admin_remarks' =>
                'Cash payment received at the Barangay Hall.',

            'payment_verified_at' =>
                now('Asia/Manila'),

        ]);


        return back()
            ->with(
                'success',
                'Cash payment marked as paid.'
            );
    }
}