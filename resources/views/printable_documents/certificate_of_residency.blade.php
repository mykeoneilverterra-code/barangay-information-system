<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Certificate of Residency -
        {{ $documentRequest->request_number }}
    </title>


    @include(
        'printable_documents._styles'
    )

</head>


<body>


<div class="print-toolbar">

    <button
        type="button"
        onclick="window.print()"
    >
        Print Document
    </button>

</div>


<main class="print-document">


    <header class="document-header">

        <p>
            {{
                config(
                    'barangay.office.country'
                )
            }}
        </p>

        <p>
            {{
                config(
                    'barangay.office.province'
                )
            }}
        </p>

        <p>
            {{
                config(
                    'barangay.office.city'
                )
            }}
        </p>

        <h2>
            {{
                config(
                    'barangay.office.barangay'
                )
            }}
        </h2>

        <p>
            OFFICE OF THE PUNONG BARANGAY
        </p>

    </header>


    <div class="document-divider"></div>


    <div class="document-title">
        Certificate of Residency
    </div>


    <section class="document-body">


        <p>
            TO WHOM IT MAY CONCERN:
        </p>


        <p>

            This is to certify that

            <span class="resident-name">
                {{ $resident->full_name }}
            </span>

            is a bona fide resident of

            <strong>
                {{ $resident->address }},
                {{ $resident->area }},
                Barangay San Antonio,
                City of Biñan, Laguna
            </strong>,

            based on the resident information
            recorded in this barangay.

        </p>


        <p>

            This certification is issued upon
            the resident's request for

            <strong>
                {{ $documentRequest->purpose }}
            </strong>.

        </p>


        <p class="document-issued">

            Issued this

            <strong>
                {{ $issuedDate->format('jS') }}
            </strong>

            day of

            <strong>
                {{ $issuedDate->format('F Y') }}
            </strong>

            at Barangay San Antonio,
            City of Biñan, Laguna.

        </p>


    </section>


    <div class="document-signature">

        <div class="document-signature-line">

            {{
                config(
                    'barangay.office.signatory_name'
                )
            }}

        </div>

        <div class="document-signature-position">

            {{
                config(
                    'barangay.office.signatory_position'
                )
            }}

        </div>

    </div>


    <footer class="document-footer">

        <span>
            Request No:
            {{ $documentRequest->request_number }}
        </span>

        <span>
            Generated:
            {{ $issuedDate->format('M d, Y') }}
        </span>

    </footer>


</main>


</body>

</html>