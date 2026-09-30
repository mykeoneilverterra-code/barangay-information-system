<style>

@page {
    size: A4;

    margin: 15mm;
}


* {
    box-sizing: border-box;
}


body {
    margin: 0;

    background: #eef2f2;

    color: #111827;

    font-family:
        "Times New Roman",
        serif;
}


.print-toolbar {
    max-width: 210mm;

    margin: 20px auto 10px;

    display: flex;
    justify-content: flex-end;

    gap: 8px;
}


.print-toolbar button {
    min-height: 40px;

    padding: 0 16px;

    border: 0;

    border-radius: 8px;

    background: #087d71;

    color: #ffffff;

    font-family:
        Arial,
        sans-serif;

    font-weight: 700;

    cursor: pointer;
}


.print-document {
    width: 210mm;

    min-height: 297mm;

    margin: 0 auto 30px;

    padding:
        20mm 18mm;

    background: #ffffff;

    box-shadow:
        0 10px 35px
        rgba(15, 23, 42, .12);
}


.document-header {
    text-align: center;
}


.document-header p {
    margin: 2px 0;

    font-size: 14px;
}


.document-header h2 {
    margin:
        5px 0 2px;

    font-size: 19px;

    text-transform: uppercase;
}


.document-divider {
    height: 2px;

    margin: 16px 0 26px;

    background: #111827;
}


.document-title {
    margin-bottom: 34px;

    text-align: center;

    font-size: 24px;
    font-weight: 700;

    text-decoration: underline;

    text-transform: uppercase;
}


.document-body {
    font-size: 16px;

    line-height: 1.85;

    text-align: justify;
}


.document-body p {
    margin:
        0 0 18px;
}


.document-body .resident-name {
    font-weight: 700;

    text-transform: uppercase;
}


.document-purpose {
    margin-top: 20px;
}


.document-issued {
    margin-top: 25px;
}


.document-signature {
    width: 280px;

    margin:
        80px 0 0 auto;

    text-align: center;
}


.document-signature-line {
    padding-top: 8px;

    border-top:
        1px solid #111827;

    font-weight: 700;
}


.document-signature-position {
    margin-top: 4px;

    font-size: 14px;
}


.document-footer {
    margin-top: 70px;

    padding-top: 12px;

    border-top:
        1px solid #d1d5db;

    display: flex;
    justify-content: space-between;

    gap: 20px;

    color: #6b7280;

    font-family:
        Arial,
        sans-serif;

    font-size: 10px;
}


@media print {

    body {
        background: #ffffff;
    }


    .print-toolbar {
        display: none;
    }


    .print-document {
        width: auto;

        min-height: auto;

        margin: 0;

        padding: 0;

        box-shadow: none;
    }

}

</style>