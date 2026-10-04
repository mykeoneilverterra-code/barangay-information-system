<style>

/* =========================================================
   ADMIN REPORTS
========================================================= */

.admin-report-page {
    width: 100%;

    display: flex;
    flex-direction: column;

    gap: 18px;
}


/* =========================================================
   HEADER
========================================================= */

.admin-report-header {
    padding: 22px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 22px;

    background: #ffffff;

    border:
        1px solid #e2ebe9;

    border-radius: 16px;

    box-shadow:
        0 7px 28px
        rgba(15, 41, 55, .035);
}


.admin-report-eyebrow {
    margin-bottom: 5px;

    color: #0b8175;

    font-size: 9px;
    font-weight: 800;

    letter-spacing: 1.4px;

    text-transform: uppercase;
}


.admin-report-header h2 {
    margin: 0;

    color: #17223b;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 24px;
}


.admin-report-header p {
    margin:
        5px 0 0;

    color: #74839a;

    font-size: 12px;
}


.admin-report-actions {
    display: flex;
    align-items: center;

    gap: 8px;
}


/* =========================================================
   BUTTON
========================================================= */

.report-primary-button,
.report-secondary-button {
    min-height: 40px;

    padding:
        0 14px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    border-radius: 9px;

    font-size: 11px;
    font-weight: 700;

    text-decoration: none;

    cursor: pointer;
}


.report-primary-button {
    border: 0;

    background: #0b8478;

    color: #ffffff;
}


.report-primary-button:hover {
    background: #08756b;

    color: #ffffff;
}


.report-secondary-button {
    border:
        1px solid #dce5ea;

    background: #ffffff;

    color: #475569;
}


/* =========================================================
   FILTER
========================================================= */

.admin-report-filter {
    padding: 15px;

    display: grid;

    grid-template-columns:
        1fr
        1fr
        auto
        auto;

    gap: 10px;

    align-items: end;

    background: #ffffff;

    border:
        1px solid #e2ebe9;

    border-radius: 14px;
}


.admin-report-field {
    display: flex;
    flex-direction: column;

    gap: 6px;
}


.admin-report-field label {
    color: #64748b;

    font-size: 10px;
    font-weight: 700;
}


.admin-report-field input {
    min-height: 41px;

    padding:
        0 11px;

    border:
        1px solid #dce5ea;

    border-radius: 8px;

    color: #334155;

    font-family: inherit;

    font-size: 11px;

    outline: none;
}


/* =========================================================
   STATS
========================================================= */

.admin-report-stats {
    display: grid;

    grid-template-columns:
        repeat(
            4,
            minmax(0, 1fr)
        );

    gap: 12px;
}


.admin-report-stat {
    min-height: 94px;

    padding: 15px;

    display: flex;
    align-items: center;

    gap: 12px;

    background: #ffffff;

    border:
        1px solid #e2ebe9;

    border-radius: 13px;

    box-shadow:
        0 5px 18px
        rgba(15, 41, 55, .03);
}


.admin-report-stat-icon {
    width: 42px;
    height: 42px;

    flex:
        0 0 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #e4f7f3;

    color: #0b8679;
}


.admin-report-stat-icon svg {
    width: 21px;
    height: 21px;
}


.admin-report-stat-copy span {
    display: block;

    color: #8190a5;

    font-size: 9px;
    font-weight: 600;
}


.admin-report-stat-copy strong {
    display: block;

    margin-top: 2px;

    color: #17223b;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 20px;
    font-weight: 800;
}


.admin-report-stat-copy small {
    display: block;

    margin-top: 2px;

    color: #9aa7b9;

    font-size: 8px;
}


/* =========================================================
   TWO COLUMN REPORTS
========================================================= */

.admin-report-grid {
    display: grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap: 14px;
}


.admin-report-panel {
    overflow: hidden;

    background: #ffffff;

    border:
        1px solid #e2ebe9;

    border-radius: 14px;

    box-shadow:
        0 6px 22px
        rgba(15, 41, 55, .03);
}


.admin-report-panel-header {
    padding:
        15px 17px;

    border-bottom:
        1px solid #e9efee;
}


.admin-report-panel-header h3 {
    margin: 0;

    color: #17223b;

    font-size: 14px;
}


.admin-report-panel-header p {
    margin:
        3px 0 0;

    color: #8290a5;

    font-size: 9px;
}


/* =========================================================
   DISTRIBUTION
========================================================= */

.admin-report-distribution {
    padding: 17px;

    display: flex;
    flex-direction: column;

    gap: 14px;
}


.admin-report-bar-item {
    display: grid;

    grid-template-columns:
        150px
        minmax(0, 1fr)
        40px;

    align-items: center;

    gap: 10px;
}


.admin-report-bar-label {
    overflow: hidden;

    color: #475569;

    font-size: 10px;
    font-weight: 600;

    text-overflow: ellipsis;

    white-space: nowrap;
}


.admin-report-bar-track {
    height: 8px;

    overflow: hidden;

    background: #edf2f4;

    border-radius: 999px;
}


.admin-report-bar-fill {
    height: 100%;

    border-radius: inherit;

    background:
        linear-gradient(
            90deg,
            #078f7c,
            #46b9ab
        );
}


.admin-report-bar-total {
    color: #334155;

    font-size: 10px;
    font-weight: 800;

    text-align: right;
}


/* =========================================================
   PAYMENT SUMMARY
========================================================= */

.admin-report-payment-grid {
    padding: 17px;

    display: grid;

    grid-template-columns:
        repeat(
            3,
            minmax(0, 1fr)
        );

    gap: 11px;
}


.admin-report-payment-item {
    padding: 14px;

    background: #f8fafb;

    border:
        1px solid #edf1f3;

    border-radius: 10px;
}


.admin-report-payment-item span {
    display: block;

    color: #8392a6;

    font-size: 9px;
}


.admin-report-payment-item strong {
    display: block;

    margin-top: 5px;

    color: #17223b;

    font-size: 17px;
}


/* =========================================================
   TABLE
========================================================= */

.admin-report-table-panel {
    overflow: hidden;

    background: #ffffff;

    border:
        1px solid #e2ebe9;

    border-radius: 14px;
}


.admin-report-table-wrapper {
    width: 100%;

    overflow-x: auto;
}


.admin-report-table {
    width: 100%;

    min-width: 850px;

    border-collapse: collapse;
}


.admin-report-table th {
    padding:
        11px 13px;

    background: #f7f9fb;

    color: #65738c;

    font-size: 9px;
    font-weight: 800;

    text-align: left;

    text-transform: uppercase;
}


.admin-report-table td {
    padding:
        12px 13px;

    border-top:
        1px solid #edf1f5;

    color: #4e5d75;

    font-size: 10px;

    vertical-align: middle;
}


.admin-report-table strong {
    color: #28364f;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1100px) {

    .admin-report-stats {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }


    .admin-report-payment-grid {
        grid-template-columns: 1fr;
    }

}


@media (max-width: 850px) {

    .admin-report-header {
        align-items: flex-start;

        flex-direction: column;
    }


    .admin-report-grid {
        grid-template-columns: 1fr;
    }


    .admin-report-filter {
        grid-template-columns:
            1fr 1fr;
    }

}


@media (max-width: 600px) {

    .admin-report-stats,
    .admin-report-filter {
        grid-template-columns: 1fr;
    }


    .admin-report-actions {
        width: 100%;

        align-items: stretch;

        flex-direction: column;
    }


    .admin-report-actions a {
        width: 100%;
    }

}

</style>