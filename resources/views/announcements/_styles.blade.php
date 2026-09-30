<style>

    /* =====================================================
       ANNOUNCEMENTS MODULE ONLY
    ====================================================== */

    .announcement-page {
        width: 100%;

        display: flex;
        flex-direction: column;

        gap: 18px;
    }


    /* Breadcrumb */

    .announcement-breadcrumb {
        display: flex;
        align-items: center;

        gap: 8px;

        color: #94a3b8;

        font-size: 11px;
    }

    .announcement-breadcrumb a {
        color: #718096;

        text-decoration: none;
    }

    .announcement-breadcrumb a:hover {
        color: #078f7c;
    }

    .announcement-breadcrumb strong {
        color: #334155;

        font-weight: 700;
    }


    /* =====================================================
       HEADING
    ====================================================== */

    .announcement-page-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 22px;
    }

    .announcement-eyebrow {
        display: block;

        margin-bottom: 5px;

        color: #078f7c;

        font-size: 9px;
        font-weight: 800;

        letter-spacing: 1.4px;

        text-transform: uppercase;
    }

    .announcement-page-heading h2,
    .announcement-form-heading h2 {
        margin: 0;

        color: #17213b;

        font-family:
            "Plus Jakarta Sans",
            sans-serif;

        font-size: 25px;
        font-weight: 800;

        letter-spacing: -0.5px;
    }

    .announcement-page-heading p,
    .announcement-form-heading p {
        margin: 5px 0 0;

        color: #7c8ba2;

        font-size: 12px;
    }


    /* =====================================================
       BUTTONS
    ====================================================== */

    .announcement-button-primary,
    .announcement-button-secondary,
    .announcement-button-danger {
        min-height: 40px;

        padding: 0 15px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        border-radius: 9px;

        font-family: inherit;

        font-size: 12px;
        font-weight: 700;

        text-decoration: none;

        cursor: pointer;
    }

    .announcement-button-primary {
        border: 0;

        background: #0b8478;

        color: #ffffff;

        box-shadow:
            0 6px 18px
            rgba(11, 132, 120, 0.15);
    }

    .announcement-button-primary:hover {
        background: #08756b;

        color: #ffffff;
    }

    .announcement-button-secondary {
        border:
            1px solid #dce5ea;

        background: #ffffff;

        color: #475569;
    }

    .announcement-button-secondary:hover {
        background: #f8fafc;
    }

    .announcement-button-danger {
        border: 0;

        background: #ef4444;

        color: #ffffff;
    }

    .announcement-button-danger:hover {
        background: #dc2626;
    }


    /* =====================================================
       STATISTICS
    ====================================================== */

    .announcement-stats {
        display: grid;

        grid-template-columns:
            repeat(
                3,
                minmax(0, 1fr)
            );

        gap: 13px;
    }

    .announcement-stat-card {
        min-height: 82px;

        padding: 14px 17px;

        display: flex;
        align-items: center;

        gap: 13px;

        background: #ffffff;

        border:
            1px solid #e2ebe9;

        border-radius: 14px;

        box-shadow:
            0 5px 20px
            rgba(15, 41, 55, 0.035);
    }

    .announcement-stat-icon {
        width: 44px;
        height: 44px;

        flex: 0 0 44px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;
    }

    .announcement-stat-icon svg {
        width: 20px;
        height: 20px;
    }

    .announcement-stat-icon.total {
        background: #e5f7f3;

        color: #078f7c;
    }

    .announcement-stat-icon.published {
        background: #e9f9ef;

        color: #15803d;
    }

    .announcement-stat-icon.draft {
        background: #fff7df;

        color: #d48a00;
    }

    .announcement-stat-card > div:last-child {
        display: flex;
        flex-direction: column;
    }

    .announcement-stat-card span {
        color: #8594aa;

        font-size: 10px;
        font-weight: 600;
    }

    .announcement-stat-card strong {
        margin-top: 2px;

        color: #17213b;

        font-size: 21px;
        font-weight: 800;
    }


    /* =====================================================
       ALERT
    ====================================================== */

    .announcement-success-alert {
        padding: 12px 14px;

        display: flex;
        align-items: center;

        gap: 9px;

        border:
            1px solid #bce9d3;

        border-radius: 10px;

        background: #eefbf5;

        color: #166534;

        font-size: 12px;
        font-weight: 600;
    }

    .announcement-success-icon {
        width: 24px;
        height: 24px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #dcfce7;
    }


    /* =====================================================
       TABLE CARD
    ====================================================== */

    .announcement-table-card {
        overflow: hidden;

        background: #ffffff;

        border:
            1px solid #e2ebe9;

        border-radius: 15px;

        box-shadow:
            0 6px 22px
            rgba(15, 41, 55, 0.035);
    }


    /* Filters */

    .announcement-filters {
        padding: 14px;

        display: grid;

        grid-template-columns:
            minmax(260px, 1fr)
            190px
            160px
            auto
            auto;

        align-items: center;

        gap: 9px;

        border-bottom:
            1px solid #edf1f5;
    }

    .announcement-search {
        min-height: 40px;

        padding: 0 12px;

        display: flex;
        align-items: center;

        gap: 8px;

        border:
            1px solid #dce5ea;

        border-radius: 9px;

        background: #ffffff;
    }

    .announcement-search svg {
        width: 16px;
        height: 16px;

        flex: 0 0 16px;

        color: #94a3b8;
    }

    .announcement-search input {
        width: 100%;

        border: 0;

        outline: 0;

        background: transparent;

        color: #334155;

        font-family: inherit;

        font-size: 12px;
    }

    .announcement-search input::placeholder {
        color: #a4afbf;
    }

    .announcement-filters select {
        width: 100%;

        min-height: 40px;

        padding: 0 11px;

        border:
            1px solid #dce5ea;

        border-radius: 9px;

        background: #ffffff;

        color: #475569;

        font-family: inherit;

        font-size: 12px;

        outline: none;
    }

    .announcement-filter-button {
        min-height: 40px;

        padding: 0 15px;

        border: 0;
        border-radius: 9px;

        background: #0b8478;

        color: #ffffff;

        font-size: 12px;
        font-weight: 700;

        cursor: pointer;
    }

    .announcement-clear-filter {
        color: #64748b;

        font-size: 11px;
        font-weight: 600;

        text-decoration: none;
    }


    /* =====================================================
       TABLE
    ====================================================== */

    .announcement-table-wrap {
        width: 100%;

        overflow-x: auto;
    }

    .announcement-table {
        width: 100%;

        min-width: 850px;

        border-collapse: collapse;
    }

    .announcement-table thead {
        background: #f7f9fb;
    }

    .announcement-table th {
        padding: 11px 14px;

        color: #65738c;

        font-size: 10px;
        font-weight: 800;

        letter-spacing: 0.025em;

        text-align: left;

        text-transform: uppercase;

        white-space: nowrap;
    }

    .announcement-table td {
        padding: 13px 14px;

        vertical-align: middle;

        border-top:
            1px solid #edf1f5;

        color: #4e5d75;

        font-size: 12px;
    }

    .announcement-table tbody tr:hover {
        background: #fbfdfd;
    }

    .announcement-row-number {
        width: 45px;

        color: #94a3b8 !important;
    }

    .announcement-title-cell {
        min-width: 250px;

        display: flex;
        flex-direction: column;

        gap: 3px;
    }

    .announcement-title-cell strong {
        color: #24304a;

        font-size: 12px;
        font-weight: 700;
    }

    .announcement-title-cell span {
        max-width: 390px;

        overflow: hidden;

        color: #94a3b8;

        font-size: 10px;

        white-space: nowrap;

        text-overflow: ellipsis;
    }


    /* =====================================================
       BADGES
    ====================================================== */

    .announcement-category-badge,
    .announcement-status-badge {
        width: max-content;

        padding: 5px 9px;

        display: inline-flex;
        align-items: center;

        border-radius: 999px;

        font-size: 9px;
        font-weight: 700;

        white-space: nowrap;
    }

    .announcement-category-badge.community {
        background: #f0e9ff;

        color: #7c3aed;
    }

    .announcement-category-badge.youth {
        background: #e7f0ff;

        color: #2563eb;
    }

    .announcement-category-badge.health {
        background: #e8f8ee;

        color: #15803d;
    }

    .announcement-category-badge.government {
        background: #fff0dc;

        color: #c56a0a;
    }

    .announcement-category-badge.emergency {
        background: #ffe9e9;

        color: #dc2626;
    }

    .announcement-category-badge.other {
        background: #eef2f7;

        color: #64748b;
    }

    .announcement-status-badge.published {
        background: #dcf7e7;

        color: #18733b;
    }

    .announcement-status-badge.draft {
        background: #fff0ca;

        color: #b46c00;
    }


    /* =====================================================
       ACTIONS
    ====================================================== */

    .announcement-actions-heading {
        text-align: center !important;
    }

    .announcement-row-actions {
        display: flex;
        align-items: center;
        justify-content: center;

        gap: 5px;
    }

    .announcement-icon-button {
        width: 29px;
        height: 29px;

        padding: 0;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border: 0;
        border-radius: 7px;

        text-decoration: none;

        cursor: pointer;
    }

    .announcement-icon-button svg {
        width: 14px;
        height: 14px;
    }

    .announcement-icon-button.view {
        background: #eff6ff;

        color: #2563eb;
    }

    .announcement-icon-button.edit {
        background: #effaf7;

        color: #078f7c;
    }

    .announcement-icon-button.delete {
        background: #fff0f0;

        color: #dc2626;
    }


    /* =====================================================
       PAGINATION
    ====================================================== */

    .announcement-pagination {
        padding: 12px 14px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        border-top:
            1px solid #edf1f5;

        color: #74839a;

        font-size: 11px;
    }

    .announcement-pagination-controls {
        display: flex;

        gap: 5px;
    }

    .announcement-pagination-controls a,
    .announcement-pagination-controls span {
        width: 30px;
        height: 30px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border:
            1px solid #dfe7ed;

        border-radius: 7px;

        text-decoration: none;
    }

    .announcement-pagination-controls a {
        color: #475569;
    }

    .announcement-pagination-controls .current {
        background: #078f7c;

        border-color: #078f7c;

        color: #ffffff;
    }

    .announcement-pagination-controls .disabled {
        color: #cbd5e1;
    }


    /* =====================================================
       EMPTY
    ====================================================== */

    .announcement-empty {
        padding: 45px 20px !important;

        text-align: center;
    }

    .announcement-empty svg {
        width: 28px;
        height: 28px;

        margin-bottom: 8px;

        color: #94a3b8;
    }

    .announcement-empty strong,
    .announcement-empty span {
        display: block;
    }

    .announcement-empty strong {
        color: #334155;
    }

    .announcement-empty span {
        margin-top: 4px;

        color: #94a3b8;

        font-size: 11px;
    }


    /* =====================================================
       FORM
    ====================================================== */

    .announcement-form-card {
        padding: 24px;

        background: #ffffff;

        border:
            1px solid #e2ebe9;

        border-radius: 16px;

        box-shadow:
            0 6px 22px
            rgba(15, 41, 55, 0.035);
    }

    .announcement-form-heading {
        margin-bottom: 22px;
    }

    .announcement-form-grid {
        display: grid;

        grid-template-columns:
            minmax(0, .75fr)
            minmax(0, 1.25fr);

        gap: 28px;
    }

    .announcement-form-column {
        display: flex;
        flex-direction: column;

        gap: 18px;
    }

    .announcement-field {
        display: flex;
        flex-direction: column;

        gap: 7px;
    }

    .announcement-field label {
        color: #334155;

        font-size: 12px;
        font-weight: 700;
    }

    .announcement-field label span {
        color: #ef4444;
    }

    .announcement-field input,
    .announcement-field select,
    .announcement-field textarea {
        width: 100%;

        box-sizing: border-box;

        border:
            1px solid #d9e2e8;

        border-radius: 9px;

        background: #ffffff;

        color: #334155;

        font-family: inherit;

        font-size: 13px;

        outline: none;
    }

    .announcement-field input,
    .announcement-field select {
        min-height: 43px;

        padding: 0 12px;
    }

    .announcement-field textarea {
        min-height: 190px;

        padding: 13px;

        resize: vertical;

        line-height: 1.6;
    }

    .announcement-field input:focus,
    .announcement-field select:focus,
    .announcement-field textarea:focus {
        border-color: #3bb7a7;

        box-shadow:
            0 0 0 3px
            rgba(7, 143, 124, 0.09);
    }

    .announcement-field-error {
        color: #dc2626;

        font-size: 11px;
        font-weight: 600;
    }

    .announcement-character-note {
        color: #9aa6b9;

        font-size: 10px;

        text-align: right;
    }

    .announcement-form-actions {
        margin-top: 25px;
        padding-top: 18px;

        display: flex;
        justify-content: flex-end;

        gap: 10px;

        border-top:
            1px solid #edf1f5;
    }


    /* =====================================================
       SHOW
    ====================================================== */

    .announcement-show-actions {
        display: flex;
        justify-content: flex-end;

        gap: 9px;
    }

    .announcement-detail-card {
        overflow: hidden;

        background: #ffffff;

        border:
            1px solid #e2ebe9;

        border-radius: 16px;

        box-shadow:
            0 6px 22px
            rgba(15, 41, 55, 0.035);
    }

    .announcement-detail-hero {
        padding: 24px;

        display: flex;
        align-items: center;

        gap: 18px;

        background:
            linear-gradient(
                115deg,
                #f0faf7,
                #def7e9
            );
    }

    .announcement-detail-icon {
        width: 62px;
        height: 62px;

        flex: 0 0 62px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 18px;

        background: #e9ddff;

        color: #7c3aed;
    }

    .announcement-detail-icon svg {
        width: 27px;
        height: 27px;
    }

    .announcement-detail-heading h2 {
        margin: 8px 0 7px;

        color: #17213b;

        font-size: 24px;
    }

    .announcement-detail-meta {
        display: flex;
        align-items: center;

        gap: 12px;

        color: #64748b;

        font-size: 11px;
    }

    .announcement-detail-body {
        padding: 23px;
    }

    .announcement-detail-section
    + .announcement-detail-section {
        margin-top: 23px;
        padding-top: 21px;

        border-top:
            1px solid #edf1f5;
    }

    .announcement-detail-section h3 {
        margin: 0 0 9px;

        color: #25304a;

        font-size: 15px;
    }

    .announcement-detail-section p {
        margin: 0;

        color: #64748b;

        line-height: 1.7;
    }

    .announcement-detail-grid {
        display: grid;

        grid-template-columns:
            repeat(
                5,
                minmax(0, 1fr)
            );

        gap: 12px;
    }

    .announcement-detail-grid > div {
        padding: 13px;

        background: #f8fafc;

        border-radius: 11px;
    }

    .announcement-detail-grid span,
    .announcement-detail-grid strong {
        display: block;
    }

    .announcement-detail-grid span {
        margin-bottom: 5px;

        color: #94a3b8;

        font-size: 10px;
        font-weight: 700;
    }

    .announcement-detail-grid strong {
        color: #334155;

        font-size: 12px;
    }


    /* =====================================================
       DELETE MODAL
    ====================================================== */

    body.announcement-modal-open {
        overflow: hidden;
    }

    .announcement-modal-backdrop[hidden] {
        display: none;
    }

    .announcement-modal-backdrop {
        position: fixed;

        inset: 0;

        z-index: 9999;

        padding: 20px;

        display: flex;
        align-items: center;
        justify-content: center;

        background:
            rgba(15, 23, 42, .62);

        backdrop-filter: blur(3px);
    }

    .announcement-delete-modal {
        width:
            min(420px, 100%);

        padding: 28px;

        background: #ffffff;

        border-radius: 17px;

        text-align: center;

        box-shadow:
            0 30px 70px
            rgba(15, 23, 42, .24);
    }

    .announcement-delete-icon {
        width: 56px;
        height: 56px;

        margin:
            0 auto 14px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #ffe7e7;

        color: #dc2626;
    }

    .announcement-delete-icon svg {
        width: 24px;
        height: 24px;
    }

    .announcement-delete-modal h3 {
        margin: 0;

        color: #17213b;

        font-size: 18px;
    }

    .announcement-delete-modal p {
        margin:
            10px 0 3px;

        color: #64748b;

        line-height: 1.5;
    }

    .announcement-delete-warning {
        color: #94a3b8;

        font-size: 11px;
    }

    .announcement-delete-actions {
        margin-top: 22px;

        display: flex;
        justify-content: center;

        gap: 9px;
    }


    /* =====================================================
       RESPONSIVE
    ====================================================== */

    @media (max-width: 1100px) {

        .announcement-filters {
            grid-template-columns:
                1fr 1fr;
        }

        .announcement-search {
            grid-column:
                1 / -1;
        }

        .announcement-detail-grid {
            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );
        }

    }


    @media (max-width: 800px) {

        .announcement-page-heading {
            align-items: stretch;

            flex-direction: column;
        }

        .announcement-stats {
            grid-template-columns: 1fr;
        }

        .announcement-form-grid {
            grid-template-columns: 1fr;
        }

        .announcement-detail-grid {
            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );
        }

    }


    @media (max-width: 560px) {

        .announcement-filters {
            grid-template-columns: 1fr;
        }

        .announcement-search {
            grid-column: auto;
        }

        .announcement-form-card {
            padding: 18px;
        }

        .announcement-detail-grid {
            grid-template-columns: 1fr;
        }

        .announcement-delete-actions {
            flex-direction:
                column-reverse;
        }

        .announcement-delete-actions button {
            width: 100%;
        }

    }

</style>