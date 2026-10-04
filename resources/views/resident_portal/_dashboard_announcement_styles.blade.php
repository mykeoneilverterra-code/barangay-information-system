<style>

/* =========================================================
   RESIDENT DASHBOARD — ANNOUNCEMENTS
   Matches the CURRENT dashboard.blade.php classes
========================================================= */


/* =========================================================
   ANNOUNCEMENT GRID
========================================================= */

.resident-dashboard-announcement-grid {
    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 12px;

    padding: 16px;
}


/* =========================================================
   ANNOUNCEMENT CARD
========================================================= */

.resident-dashboard-announcement-card {
    min-width: 0;
    min-height: 180px;

    display: flex;
    flex-direction: column;

    padding: 15px;

    background: #ffffff;

    border: 1px solid #e3ebe9;
    border-radius: 12px;

    box-shadow:
        0 3px 12px
        rgba(15, 41, 55, 0.025);
}


/* =========================================================
   CARD TOP
========================================================= */

.resident-dashboard-announcement-top {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 10px;

    margin-bottom: 12px;
}


/* =========================================================
   ICON
========================================================= */

.resident-dashboard-announcement-icon {
    width: 38px;
    height: 38px;

    flex: 0 0 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;

    border-radius: 10px;
}


/*
|--------------------------------------------------------------------------
| IMPORTANT
|--------------------------------------------------------------------------
| This prevents the SVG from becoming huge.
*/

.resident-dashboard-announcement-icon svg {
    width: 20px !important;
    height: 20px !important;

    max-width: 20px !important;
    max-height: 20px !important;

    display: block;

    flex: 0 0 20px;
}


/* =========================================================
   CATEGORY ICON COLORS
========================================================= */

.resident-announcement-health {
    background: #e8f8ee;

    color: #15803d;
}


.resident-announcement-community {
    background: #f1eaff;

    color: #7c3aed;
}


.resident-announcement-youth {
    background: #e8f1ff;

    color: #2563eb;
}


.resident-announcement-government {
    background: #fff1df;

    color: #c56a0a;
}


.resident-announcement-emergency {
    background: #ffe8e8;

    color: #dc2626;
}


.resident-announcement-other {
    background: #e8f6f3;

    color: #078f7c;
}


/* =========================================================
   CATEGORY BADGE
========================================================= */

.resident-dashboard-announcement-category {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 4px 7px;

    border-radius: 999px;

    font-size: 8px;
    font-weight: 700;

    white-space: nowrap;
}


.resident-category-health {
    background: #e8f8ee;

    color: #15803d;
}


.resident-category-community {
    background: #f1eaff;

    color: #7c3aed;
}


.resident-category-youth {
    background: #e8f1ff;

    color: #2563eb;
}


.resident-category-government {
    background: #fff1df;

    color: #c56a0a;
}


.resident-category-emergency {
    background: #ffe8e8;

    color: #dc2626;
}


.resident-category-other {
    background: #e8f6f3;

    color: #078f7c;
}


/* =========================================================
   CONTENT
========================================================= */

.resident-dashboard-announcement-content {
    min-width: 0;

    flex: 1;
}


.resident-dashboard-announcement-content h4 {
    margin: 0;

    color: #17223b;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 14px;
    font-weight: 700;

    line-height: 1.4;
}


.resident-dashboard-announcement-content p {
    margin: 6px 0 0;

    color: #697c94;

    font-size: 11.5px;

    line-height: 1.6;

    display: -webkit-box;

    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;

    overflow: hidden;
}


/* =========================================================
   DATE
========================================================= */

.resident-dashboard-announcement-date {
    display: flex;
    align-items: center;

    gap: 6px;

    margin-top: 14px;

    padding-top: 11px;

    color: #7f91a7;

    font-size: 10px;
}


.resident-dashboard-announcement-date svg {
    width: 13px !important;
    height: 13px !important;

    max-width: 13px !important;
    max-height: 13px !important;

    flex: 0 0 13px;

    display: block;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.resident-dashboard-announcement-empty {
    grid-column: 1 / -1;

    padding: 35px 20px;

    color: #94a3b8;

    font-size: 12px;

    text-align: center;
}


/* =========================================================
   DASHBOARD SECTION SAFETY
========================================================= */

.resident-modern-dashboard {
    width: 100%;

    display: flex;
    flex-direction: column;

    gap: 18px;
}


.resident-modern-section {
    width: 100%;

    min-width: 0;
}


/* =========================================================
   SVG SAFETY
   Only applies inside announcement cards.
========================================================= */

.resident-dashboard-announcement-card svg {
    overflow: visible;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1250px) {

    .resident-dashboard-announcement-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

}


@media (max-width: 700px) {

    .resident-dashboard-announcement-grid {
        grid-template-columns: 1fr;

        padding: 13px;
    }


    .resident-dashboard-announcement-card {
        min-height: 165px;
    }

}

</style>