<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ResidentPaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Payment Page
    |--------------------------------------------------------------------------
    */

    public function choose(
        DocumentRequest $documentRequest
    ) {

        $this->ensureOwner(
            $documentRequest
        );


        if (!$documentRequest->payment_required) {

            return redirect()
                ->route(
                    'resident.requests.show',
                    $documentRequest
                )
                ->with(
                    'success',
                    'This document does not require payment.'
                );

        }


        if (
            in_array(
                $documentRequest->status,
                [
                    'Cancelled',
                    'Released',
                ],
                true
            )
        ) {

            return redirect()
                ->route(
                    'resident.requests.show',
                    $documentRequest
                )
                ->with(
                    'error',
                    'Payment is no longer available for this request.'
                );

        }


        return view(
            'resident_portal.payments.choose',
            compact('documentRequest')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Select GCash or Cash
    |--------------------------------------------------------------------------
    */

    public function selectMethod(
        Request $request,
        DocumentRequest $documentRequest
    ) {

        $this->ensureOwner(
            $documentRequest
        );


        if (!$documentRequest->payment_required) {

            return redirect()
                ->route(
                    'resident.requests.show',
                    $documentRequest
                );

        }


        if ($documentRequest->payment_status === 'Paid') {

            return back()
                ->with(
                    'error',
                    'This request is already paid.'
                );

        }


        if (
            $documentRequest->payment_status
            === 'Pending Verification'
        ) {

            return back()
                ->with(
                    'error',
                    'Your GCash payment is currently waiting for administrator verification.'
                );

        }


        $validated =
            $request->validate([

                'payment_method' => [
                    'required',
                    Rule::in([
                        'GCash',
                        'Cash',
                    ]),
                ],

            ]);


        /*
        |--------------------------------------------------------------------------
        | Delete Previous Proof When Changing Method
        |--------------------------------------------------------------------------
        */

        if (
            $documentRequest->payment_proof_path
            && Storage::disk('local')->exists(
                $documentRequest->payment_proof_path
            )
        ) {

            Storage::disk('local')->delete(
                $documentRequest->payment_proof_path
            );

        }


        $documentRequest->update([

            'payment_method' =>
                $validated['payment_method'],

            'payment_status' =>
                'Unpaid',

            'payment_reference' =>
                null,

            'payment_proof_path' =>
                null,

            'payment_admin_remarks' =>
                null,

            'payment_submitted_at' =>
                null,

            'payment_verified_at' =>
                null,

        ]);


        return redirect()
            ->route(
                'resident.payments.choose',
                $documentRequest
            )
            ->with(
                'success',
                $validated['payment_method']
                . ' selected as your payment method.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Submit GCash Proof
    |--------------------------------------------------------------------------
    */

    public function submitGcash(
        Request $request,
        DocumentRequest $documentRequest
    ) {

        $this->ensureOwner(
            $documentRequest
        );


        if (
            $documentRequest->payment_method
            !== 'GCash'
        ) {

            return back()
                ->with(
                    'error',
                    'Please select GCash as your payment method first.'
                );

        }


        if ($documentRequest->payment_status === 'Paid') {

            return back()
                ->with(
                    'error',
                    'This request is already paid.'
                );

        }


        $validated =
            $request->validate([

                'payment_reference' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'payment_proof' => [
                    'required',
                    'file',
                    'mimes:jpg,jpeg,png,pdf',
                    'max:4096',
                ],

            ], [

                'payment_reference.required' =>
                    'Please enter the GCash reference number.',

                'payment_proof.required' =>
                    'Please upload your GCash payment receipt.',

                'payment_proof.mimes' =>
                    'Payment proof must be JPG, JPEG, PNG, or PDF.',

                'payment_proof.max' =>
                    'Payment proof must not exceed 4 MB.',

            ]);


        /*
        |--------------------------------------------------------------------------
        | Remove Previous Proof
        |--------------------------------------------------------------------------
        */

        if (
            $documentRequest->payment_proof_path
            && Storage::disk('local')->exists(
                $documentRequest->payment_proof_path
            )
        ) {

            Storage::disk('local')->delete(
                $documentRequest->payment_proof_path
            );

        }


        /*
        |--------------------------------------------------------------------------
        | PRIVATE STORAGE
        |--------------------------------------------------------------------------
        |
        | We intentionally use the local/private disk rather than public
        | storage because GCash receipts may contain sensitive information.
        |
        */

        $proofPath =
            $request
                ->file('payment_proof')
                ->store(
                    'payment-proofs',
                    'local'
                );


        $documentRequest->update([

            'payment_reference' =>
                $validated[
                    'payment_reference'
                ],

            'payment_proof_path' =>
                $proofPath,

            'payment_status' =>
                'Pending Verification',

            'payment_admin_remarks' =>
                null,

            'payment_submitted_at' =>
                now('Asia/Manila'),

            'payment_verified_at' =>
                null,

        ]);


        return redirect()
            ->route(
                'resident.requests.show',
                $documentRequest
            )
            ->with(
                'success',
                'GCash payment proof submitted. Please wait for administrator verification.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Resident View Own Proof
    |--------------------------------------------------------------------------
    */

    public function proof(
        DocumentRequest $documentRequest
    ) {

        $this->ensureOwner(
            $documentRequest
        );


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
    | Ownership Protection
    |--------------------------------------------------------------------------
    */

    private function ensureOwner(
        DocumentRequest $documentRequest
    ): void {

        $resident =
            auth()
                ->user()
                ->resident;


        abort_unless(
            $resident,
            403
        );


        abort_unless(
            (int) $documentRequest->resident_id
            === (int) $resident->id,
            403
        );
    }
}