<style>

/* =========================================================
   RESIDENT — ALL ANNOUNCEMENTS PAGE
========================================================= */

.resident-announcements-page {
    width: 100%;

    display: flex;
    flex-direction: column;

    gap: 18px;
}


/* =========================================================
   PAGE HERO
========================================================= */

.resident-announcements-hero {
    min-height: 150px;

    padding: 24px 26px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 25px;

    overflow: hidden;

    position: relative;

    background:
        linear-gradient(
            120deg,
            #ffffff 0%,
            #f5fbf9 62%,
            #e7f7f3 100%
        );

    border:
        1px solid #e2ebe9;

    border-radius: 16px;

    box-shadow:
        0 7px 28px
        rgba(15, 41, 55, .035);
}


.resident-announcements-hero::after {
    content: "";

    position: absolute;

    width: 220px;
    height: 220px;

    right: -70px;
    top: -80px;

    border-radius: 50%;

    background:
        rgba(11, 132, 120, .055);

    pointer-events: none;
}


.resident-announcements-hero-content {
    position: relative;

    z-index: 2;

    max-width: 680px;
}


.resident-announcements-eyebrow {
    margin: 0 0 7px;

    color: #0b8175;

    font-size: 9px;
    font-weight: 800;

    letter-spacing: 1.5px;

    text-transform: uppercase;
}


.resident-announcements-hero h2 {
    margin: 0;

    color: #17223b;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 26px;
    font-weight: 750;

    letter-spacing: -.6px;
}


.resident-announcements-hero-description {
    margin: 8px 0 0;

    max-width: 600px;

    color: #64748b;

    font-size: 13px;

    line-height: 1.6;
}


/* =========================================================
   HERO RIGHT
========================================================= */

.resident-announcements-hero-right {
    position: relative;

    z-index: 2;

    display: flex;
    align-items: center;

    gap: 12px;
}


.resident-announcements-count {
    min-width: 115px;

    padding: 12px 15px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    background: #ffffff;

    border:
        1px solid #dfeae7;

    border-radius: 11px;

    text-align: center;

    box-shadow:
        0 5px 16px
        rgba(15, 41, 55, .04);
}


.resident-announcements-count strong {
    color: #087d72;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 21px;
    font-weight: 800;
}


.resident-announcements-count span {
    margin-top: 2px;

    color: #8594a8;

    font-size: 9px;
    font-weight: 600;
}


.resident-announcements-back {
    min-height: 40px;

    padding: 0 14px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    border:
        1px solid #dce8e5;

    border-radius: 9px;

    background: #ffffff;

    color: #087d72;

    font-size: 11px;
    font-weight: 700;

    text-decoration: none;

    white-space: nowrap;

    transition:
        background .18s ease,
        transform .18s ease;
}


.resident-announcements-back:hover {
    background: #f5fbf9;

    color: #066a61;

    transform:
        translateY(-1px);
}


/* =========================================================
   CONTENT PANEL
========================================================= */

.resident-announcements-panel {
    overflow: hidden;

    background: #ffffff;

    border:
        1px solid #e2ebe9;

    border-radius: 16px;

    box-shadow:
        0 7px 28px
        rgba(15, 41, 55, .035);
}


.resident-announcements-panel-header {
    min-height: 74px;

    padding: 16px 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 18px;

    border-bottom:
        1px solid #e9efee;
}


.resident-announcements-panel-title {
    display: flex;
    align-items: center;

    gap: 11px;
}


.resident-announcements-panel-icon {
    width: 40px;
    height: 40px;

    flex: 0 0 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #e3f7f3;

    color: #0b887b;
}


.resident-announcements-panel-icon svg {
    width: 21px;
    height: 21px;
}


.resident-announcements-panel-copy span {
    display: block;

    margin-bottom: 2px;

    color: #0b8175;

    font-size: 9px;
    font-weight: 800;

    letter-spacing: 1.3px;

    text-transform: uppercase;
}


.resident-announcements-panel-copy h3 {
    margin: 0;

    color: #17223b;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 17px;
}


/* =========================================================
   GRID
========================================================= */

.resident-announcements-grid {
    padding: 18px;

    display: grid;

    grid-template-columns:
        repeat(
            3,
            minmax(0, 1fr)
        );

    gap: 14px;
}


/* =========================================================
   CARD
========================================================= */

.resident-announcement-full-card {
    min-height: 230px;

    padding: 18px;

    display: flex;
    flex-direction: column;

    background: #ffffff;

    border:
        1px solid #e5edeb;

    border-radius: 13px;

    transition:
        border-color .18s ease,
        transform .18s ease,
        box-shadow .18s ease;
}


.resident-announcement-full-card:hover {
    transform:
        translateY(-2px);

    border-color: #cfe3df;

    box-shadow:
        0 9px 24px
        rgba(15, 41, 55, .06);
}


.resident-announcement-full-top {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 10px;
}


/* =========================================================
   ICON
========================================================= */

.resident-announcement-full-icon {
    width: 42px;
    height: 42px;

    flex: 0 0 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;
}


.resident-announcement-full-icon svg {
    width: 22px;
    height: 22px;
}


/* =========================================================
   CATEGORY
========================================================= */

.resident-announcement-full-category {
    padding:
        5px 9px;

    display: inline-flex;
    align-items: center;

    border-radius: 999px;

    font-size: 9px;
    font-weight: 700;

    white-space: nowrap;
}


/* Community */

.resident-announcement-full-icon.community,
.resident-announcement-full-category.community {
    background: #f0eaff;

    color: #7c3aed;
}


/* Youth */

.resident-announcement-full-icon.youth,
.resident-announcement-full-category.youth {
    background: #e8f1ff;

    color: #2563eb;
}


/* Health */

.resident-announcement-full-icon.health,
.resident-announcement-full-category.health {
    background: #e8f8ee;

    color: #15803d;
}


/* Government */

.resident-announcement-full-icon.government,
.resident-announcement-full-category.government {
    background: #fff0dc;

    color: #c56a0a;
}


/* Emergency */

.resident-announcement-full-icon.emergency,
.resident-announcement-full-category.emergency {
    background: #ffe9e9;

    color: #dc2626;
}


/* Other */

.resident-announcement-full-icon.other,
.resident-announcement-full-category.other {
    background: #eef2f7;

    color: #64748b;
}


/* =========================================================
   CARD CONTENT
========================================================= */

.resident-announcement-full-card h4 {
    margin:
        15px 0 8px;

    color: #17223b;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 15px;
    font-weight: 750;

    line-height: 1.4;
}


.resident-announcement-full-card p {
    margin: 0;

    color: #64748b;

    font-size: 12px;

    line-height: 1.65;
}


.resident-announcement-full-footer {
    margin-top: auto;

    padding-top: 17px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 10px;
}


.resident-announcement-full-date {
    display: flex;
    align-items: center;

    gap: 6px;

    color: #7f8fa5;

    font-size: 10px;
    font-weight: 600;
}


.resident-announcement-full-date svg {
    width: 14px;
    height: 14px;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.resident-announcements-empty {
    grid-column:
        1 / -1;

    padding:
        55px 20px;

    text-align: center;

    background: #f8fafb;

    border-radius: 12px;
}


.resident-announcements-empty-icon {
    width: 48px;
    height: 48px;

    margin:
        0 auto 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: #e5f7f3;

    color: #0b887b;
}


.resident-announcements-empty-icon svg {
    width: 23px;
    height: 23px;
}


.resident-announcements-empty strong {
    display: block;

    color: #334155;

    font-size: 14px;
}


.resident-announcements-empty span {
    display: block;

    margin-top: 5px;

    color: #8290a5;

    font-size: 11px;
}


/* =========================================================
   PAGINATION
========================================================= */

.resident-announcements-pagination {
    min-height: 58px;

    padding:
        12px 18px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    border-top:
        1px solid #e9efee;

    color: #718096;

    font-size: 11px;
}


.resident-announcements-pagination-controls {
    display: flex;
    align-items: center;

    gap: 6px;
}


.resident-announcements-pagination-controls a,
.resident-announcements-pagination-controls span {
    min-width: 32px;
    height: 32px;

    padding:
        0 9px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border:
        1px solid #dfe7ed;

    border-radius: 7px;

    color: #475569;

    font-size: 11px;

    text-decoration: none;
}


.resident-announcements-pagination-controls a:hover {
    background: #f5fbf9;

    border-color: #cfe3df;

    color: #087d72;
}


.resident-announcements-pagination-controls .active {
    background: #078f7c;

    border-color: #078f7c;

    color: #ffffff;
}


.resident-announcements-pagination-controls .disabled {
    color: #cbd5e1;

    background: #fafafa;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1150px) {

    .resident-announcements-grid {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }

}


@media (max-width: 800px) {

    .resident-announcements-hero {
        align-items: flex-start;

        flex-direction: column;
    }


    .resident-announcements-hero-right {
        width: 100%;

        justify-content: space-between;
    }

}


@media (max-width: 650px) {

    .resident-announcements-grid {
        grid-template-columns: 1fr;
    }


    .resident-announcements-hero {
        padding: 21px 18px;
    }


    .resident-announcements-hero h2 {
        font-size: 23px;
    }


    .resident-announcements-hero-right {
        align-items: stretch;

        flex-direction: column;
    }


    .resident-announcements-count {
        width: 100%;
    }


    .resident-announcements-back {
        width: 100%;
    }


    .resident-announcements-panel-header {
        align-items: flex-start;

        flex-direction: column;
    }


    .resident-announcements-pagination {
        align-items: flex-start;

        flex-direction: column;
    }

}

</style>