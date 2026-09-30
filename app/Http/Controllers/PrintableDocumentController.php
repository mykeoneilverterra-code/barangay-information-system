<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;

class PrintableDocumentController extends Controller
{
    public function show(
        DocumentRequest $documentRequest
    ) {

        $documentRequest->load(
            'resident'
        );


        if (
            !$documentRequest
                ->canGenerateDocument()
        ) {

            abort(
                403,
                'This document cannot be generated yet. The request must be Ready for Release and payment must be completed when required.'
            );

        }


        $view =
            match (
                $documentRequest->document_type
            ) {

                'Barangay Clearance' =>
                    'printable_documents.barangay_clearance',

                'Certificate of Residency' =>
                    'printable_documents.certificate_of_residency',

                'Certificate of Indigency' =>
                    'printable_documents.certificate_of_indigency',

                default =>
                    null,

            };


        abort_unless(
            $view,
            404
        );


        return view(
            $view,
            [

                'documentRequest' =>
                    $documentRequest,

                'resident' =>
                    $documentRequest->resident,

                'issuedDate' =>
                    now('Asia/Manila'),

            ]
        );
    }
}