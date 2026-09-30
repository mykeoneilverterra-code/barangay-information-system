<style>

.payment-page {
    width: 100%;

    display: flex;
    flex-direction: column;

    gap: 18px;
}


.payment-card {
    overflow: hidden;

    background: #ffffff;

    border:
        1px solid #e2ebe9;

    border-radius: 16px;

    box-shadow:
        0 7px 26px
        rgba(15, 41, 55, 0.04);
}


.payment-card-header {
    padding: 20px 22px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 18px;

    border-bottom:
        1px solid #e8efed;
}


.payment-card-header h2 {
    margin: 0;

    color: #17213b;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 18px;
}


.payment-card-header p {
    margin: 5px 0 0;

    color: #7c8da4;

    font-size: 11px;
}


.payment-card-body {
    padding: 21px 22px;
}


.payment-grid {
    display: grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap: 14px;
}


.payment-info-item {
    padding: 13px 14px;

    background: #f8fafb;

    border:
        1px solid #edf1f3;

    border-radius: 10px;
}


.payment-info-item span {
    display: block;

    margin-bottom: 4px;

    color: #8b99ad;

    font-size: 9px;
    font-weight: 700;

    letter-spacing: .03em;

    text-transform: uppercase;
}


.payment-info-item strong {
    color: #26354e;

    font-size: 12px;

    line-height: 1.45;
}


.payment-status {
    display: inline-flex;
    align-items: center;

    padding: 5px 9px;

    border-radius: 999px;

    font-size: 9px;
    font-weight: 700;
}


.payment-status-unpaid {
    background: #fff4df;

    color: #b86b00;
}


.payment-status-pending {
    background: #e9f2ff;

    color: #2563eb;
}


.payment-status-paid {
    background: #e4f8ec;

    color: #15803d;
}


.payment-status-rejected {
    background: #ffe9e9;

    color: #dc2626;
}


.payment-status-none {
    background: #eef2f7;

    color: #64748b;
}


.payment-alert {
    padding: 12px 14px;

    border-radius: 10px;

    font-size: 11px;

    line-height: 1.5;
}


.payment-alert-success {
    background: #ecfdf5;

    border:
        1px solid #bbf7d0;

    color: #166534;
}


.payment-alert-error {
    background: #fef2f2;

    border:
        1px solid #fecaca;

    color: #b91c1c;
}


.payment-method-grid {
    display: grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap: 15px;
}


.payment-method-card {
    padding: 20px;

    border:
        1px solid #dfe9e7;

    border-radius: 14px;

    background: #ffffff;
}


.payment-method-card.selected {
    border-color: #64bdb2;

    background: #f2fbf9;
}


.payment-method-icon {
    width: 44px;
    height: 44px;

    margin-bottom: 13px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: #e5f7f3;

    color: #078f7c;

    font-size: 16px;
    font-weight: 800;
}


.payment-method-card h3 {
    margin: 0;

    color: #17213b;

    font-size: 15px;
}


.payment-method-card p {
    margin: 6px 0 0;

    color: #7c8da4;

    font-size: 11px;

    line-height: 1.55;
}


.payment-method-card form {
    margin-top: 16px;
}


.payment-primary,
.payment-secondary,
.payment-danger {
    min-height: 40px;

    padding: 0 15px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    border-radius: 9px;

    font-family: inherit;

    font-size: 11px;
    font-weight: 700;

    text-decoration: none;

    cursor: pointer;
}


.payment-primary {
    border: 0;

    background: #0b8478;

    color: #ffffff;
}


.payment-primary:hover {
    background: #08756b;

    color: #ffffff;
}


.payment-secondary {
    border:
        1px solid #dce5ea;

    background: #ffffff;

    color: #475569;
}


.payment-danger {
    border: 0;

    background: #ef4444;

    color: #ffffff;
}


.payment-form {
    display: flex;
    flex-direction: column;

    gap: 16px;
}


.payment-field {
    display: flex;
    flex-direction: column;

    gap: 7px;
}


.payment-field label {
    color: #334155;

    font-size: 11px;
    font-weight: 700;
}


.payment-field input,
.payment-field textarea {
    width: 100%;

    box-sizing: border-box;

    min-height: 43px;

    padding: 10px 12px;

    border:
        1px solid #dbe4e8;

    border-radius: 9px;

    background: #ffffff;

    color: #334155;

    font-family: inherit;

    font-size: 12px;

    outline: none;
}


.payment-field textarea {
    min-height: 90px;

    resize: vertical;
}


.payment-field input:focus,
.payment-field textarea:focus {
    border-color: #4eb4a7;

    box-shadow:
        0 0 0 3px
        rgba(11, 132, 120, .08);
}


.payment-error {
    color: #dc2626;

    font-size: 10px;
}


.gcash-box {
    padding: 20px;

    display: grid;

    grid-template-columns:
        220px
        minmax(0, 1fr);

    gap: 24px;

    border:
        1px solid #e1e9ed;

    border-radius: 14px;

    background: #fbfdfd;
}


.gcash-qr {
    width: 220px;
    height: 220px;

    padding: 10px;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;

    background: #ffffff;

    border:
        1px solid #dfe7ec;

    border-radius: 12px;
}


.gcash-qr img {
    width: 100%;
    height: 100%;

    object-fit: contain;
}


.gcash-qr-placeholder {
    color: #94a3b8;

    font-size: 11px;

    line-height: 1.5;

    text-align: center;
}


.gcash-details h3 {
    margin: 0;

    color: #17213b;

    font-size: 17px;
}


.gcash-details > p {
    margin: 6px 0 16px;

    color: #74839a;

    font-size: 11px;

    line-height: 1.55;
}


.gcash-account {
    margin-bottom: 16px;

    padding: 12px 14px;

    background: #eef8f6;

    border-radius: 10px;
}


.gcash-account span,
.gcash-account strong {
    display: block;
}


.gcash-account span {
    color: #78908c;

    font-size: 9px;
}


.gcash-account strong {
    margin-top: 3px;

    color: #07584f;

    font-size: 12px;
}


.payment-proof-link {
    display: inline-flex;
    align-items: center;

    gap: 6px;

    color: #0b8175;

    font-size: 11px;
    font-weight: 700;

    text-decoration: none;
}


.payment-actions {
    margin-top: 18px;

    display: flex;
    flex-wrap: wrap;

    gap: 9px;
}


.payment-print-ready {
    padding: 15px;

    border:
        1px solid #bcebd8;

    border-radius: 11px;

    background: #effbf5;
}


.payment-print-ready strong {
    display: block;

    color: #166534;

    font-size: 12px;
}


.payment-print-ready p {
    margin: 4px 0 0;

    color: #5f7d6c;

    font-size: 10px;
}


@media (max-width: 800px) {

    .payment-grid,
    .payment-method-grid {
        grid-template-columns: 1fr;
    }


    .gcash-box {
        grid-template-columns: 1fr;
    }


    .gcash-qr {
        width: min(
            220px,
            100%
        );

        margin: 0 auto;
    }

}

</style>