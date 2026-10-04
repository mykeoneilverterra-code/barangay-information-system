<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Barangay Administrative Report
    </title>


    <style>

        @page {
            size: A4 landscape;

            margin: 12mm;
        }


        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;

            background: #edf2f2;

            color: #111827;

            font-family:
                Arial,
                sans-serif;
        }


        .toolbar {
            max-width: 297mm;

            margin:
                15px auto 8px;

            display: flex;
            justify-content: flex-end;
        }


        .toolbar button {
            min-height: 38px;

            padding:
                0 15px;

            border: 0;

            border-radius: 7px;

            background: #087d71;

            color: white;

            font-weight: 700;

            cursor: pointer;
        }


        .report-sheet {
            width: 297mm;

            min-height: 210mm;

            margin:
                0 auto 25px;

            padding:
                15mm;

            background: #ffffff;

            box-shadow:
                0 10px 30px
                rgba(15, 23, 42, .12);
        }


        .report-header {
            text-align: center;
        }


        .report-header p {
            margin: 2px 0;

            font-size: 11px;
        }


        .report-header h1 {
            margin:
                5px 0;

            font-size: 20px;
        }


        .report-period {
            margin-top: 5px;

            font-size: 11px;
        }


        .divider {
            height: 2px;

            margin:
                12px 0 18px;

            background: #111827;
        }


        .summary-grid {
            display: grid;

            grid-template-columns:
                repeat(
                    4,
                    1fr
                );

            gap: 8px;

            margin-bottom: 18px;
        }


        .summary-item {
            padding: 10px;

            border:
                1px solid #d1d5db;

            border-radius: 5px;
        }


        .summary-item span {
            display: block;

            color: #6b7280;

            font-size: 8px;

            text-transform: uppercase;
        }


        .summary-item strong {
            display: block;

            margin-top: 4px;

            font-size: 15px;
        }


        .section-title {
            margin:
                18px 0 7px;

            font-size: 13px;
        }


        table {
            width: 100%;

            border-collapse: collapse;

            font-size: 8px;
        }


        th,
        td {
            padding:
                6px 7px;

            border:
                1px solid #d1d5db;

            text-align: left;
        }


        th {
            background: #f3f4f6;

            font-size: 7px;

            text-transform: uppercase;
        }


        .two-columns {
            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 15px;
        }


        .report-footer {
            margin-top: 20px;

            display: flex;
            justify-content: space-between;

            color: #6b7280;

            font-size: 8px;
        }


        @media print {

            body {
                background: white;
            }


            .toolbar {
                display: none;
            }


            .report-sheet {
                width: auto;

                min-height: auto;

                margin: 0;

                padding: 0;

                box-shadow: none;
            }

        }

    </style>

</head>


<body>


<div class="toolbar">

    <button
        onclick="window.print()"
    >
        Print Report
    </button>

</div>


<main class="report-sheet">


    <header class="report-header">

        <p>
            Republic of the Philippines
        </p>

        <p>
            Province of Laguna
        </p>

        <p>
            City of Biñan
        </p>

        <h1>
            BARANGAY SAN ANTONIO
        </h1>

        <strong>
            ADMINISTRATIVE REPORT
        </strong>

        <div class="report-period">

            Reporting Period:

            {{
                \Carbon\Carbon::parse(
                    $fromDate
                )->format('F d, Y')
            }}

            –

            {{
                \Carbon\Carbon::parse(
                    $toDate
                )->format('F d, Y')
            }}

        </div>

    </header>


    <div class="divider"></div>


    <section class="summary-grid">


        <div class="summary-item">

            <span>
                Total Residents
            </span>

            <strong>
                {{ $totalResidents }}
            </strong>

        </div>


        <div class="summary-item">

            <span>
                Registered Voters
            </span>

            <strong>
                {{ $registeredVoters }}
            </strong>

        </div>


        <div class="summary-item">

            <span>
                Document Requests
            </span>

            <strong>
                {{ $totalRequests }}
            </strong>

        </div>


        <div class="summary-item">

            <span>
                Released Documents
            </span>

            <strong>
                {{ $releasedRequests }}
            </strong>

        </div>


        <div class="summary-item">

            <span>
                Ready for Release
            </span>

            <strong>
                {{ $readyRequests }}
            </strong>

        </div>


        <div class="summary-item">

            <span>
                Payments Collected
            </span>

            <strong>
                ₱{{ number_format(
                    $totalCollected,
                    2
                ) }}
            </strong>

        </div>


        <div class="summary-item">

            <span>
                GCash Collected
            </span>

            <strong>
                ₱{{ number_format(
                    $gcashCollected,
                    2
                ) }}
            </strong>

        </div>


        <div class="summary-item">

            <span>
                Cash Collected
            </span>

            <strong>
                ₱{{ number_format(
                    $cashCollected,
                    2
                ) }}
            </strong>

        </div>


    </section>



    <div class="two-columns">


        <div>

            <h2 class="section-title">
                Requests by Status
            </h2>

            <table>

                <thead>

                    <tr>

                        <th>
                            Status
                        </th>

                        <th>
                            Total
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($statusDistribution as $item)

                        <tr>

                            <td>
                                {{ $item->status }}
                            </td>

                            <td>
                                {{ $item->total }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="2">
                                No data
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div>

            <h2 class="section-title">
                Requests by Document Type
            </h2>

            <table>

                <thead>

                    <tr>

                        <th>
                            Document
                        </th>

                        <th>
                            Total
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($documentTypeDistribution as $item)

                        <tr>

                            <td>
                                {{ $item->document_type }}
                            </td>

                            <td>
                                {{ $item->total }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="2">
                                No data
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


    </div>



    <h2 class="section-title">
        Document Request Records
    </h2>


    <table>

        <thead>

            <tr>

                <th>
                    Request No.
                </th>

                <th>
                    Resident
                </th>

                <th>
                    Document
                </th>

                <th>
                    Purpose
                </th>

                <th>
                    Date
                </th>

                <th>
                    Status
                </th>

                <th>
                    Payment
                </th>

                <th>
                    Amount
                </th>

            </tr>

        </thead>


        <tbody>


            @forelse($reportRequests as $requestItem)

                <tr>

                    <td>
                        {{ $requestItem->request_number }}
                    </td>

                    <td>

                        {{
                            $requestItem->resident
                                ? $requestItem
                                    ->resident
                                    ->full_name
                                : 'Unavailable'
                        }}

                    </td>

                    <td>
                        {{ $requestItem->document_type }}
                    </td>

                    <td>
                        {{ $requestItem->purpose }}
                    </td>

                    <td>

                        {{
                            $requestItem
                                ->date_requested
                                ->format('M d, Y')
                        }}

                    </td>

                    <td>
                        {{ $requestItem->status }}
                    </td>

                    <td>

                        {{
                            $requestItem
                                ->payment_method
                            ?? 'None'
                        }}

                        /

                        {{ $requestItem->payment_status }}

                    </td>

                    <td>

                        ₱{{ number_format(
                            (float)
                            $requestItem->amount,
                            2
                        ) }}

                    </td>

                </tr>


            @empty


                <tr>

                    <td colspan="8">
                        No requests for this reporting period.
                    </td>

                </tr>


            @endforelse


        </tbody>


    </table>


    <footer class="report-footer">

        <span>
            Barangay San Antonio Information System
        </span>

        <span>

            Generated:

            {{
                now(
                    'Asia/Manila'
                )->format(
                    'M d, Y h:i A'
                )
            }}

        </span>

    </footer>


</main>


</body>

</html>