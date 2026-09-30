<style>

/* =========================================================
   RESIDENT DASHBOARD + ANNOUNCEMENTS
   FINAL READABLE VERSION
========================================================= */


/* =========================================================
   DASHBOARD
========================================================= */

.resident-home-dashboard {
    width: 100%;

    display: flex;
    flex-direction: column;

    gap: 18px;
}


/* =========================================================
   HERO
========================================================= */

.resident-home-hero {
    min-height: 220px;

    display: grid;

    grid-template-columns:
        minmax(0, 1.08fr)
        minmax(380px, .92fr);

    overflow: hidden;

    background: #ffffff;

    border:
        1px solid #e2ebe9;

    border-radius: 16px;

    box-shadow:
        0 7px 28px
        rgba(15, 41, 55, .035);
}


.resident-home-hero-content {
    padding: 28px 32px;

    display: flex;
    flex-direction: column;
    justify-content: center;
}


.resident-home-eyebrow {
    margin: 0 0 8px;

    color: #0b8175;

    font-size: 10px;
    font-weight: 800;

    letter-spacing: 1.6px;

    text-transform: uppercase;
}


.resident-home-hero-content h2 {
    max-width: 580px;

    margin: 0;

    color: #13213c;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 30px;
    font-weight: 750;

    line-height: 1.2;

    letter-spacing: -.7px;
}


.resident-home-hero-description {
    max-width: 610px;

    margin:
        10px 0 0;

    color: #64748b;

    font-size: 14px;

    line-height: 1.65;
}


.resident-home-hero-actions {
    margin-top: 20px;

    display: flex;
    align-items: center;

    gap: 10px;
}


.resident-home-primary,
.resident-home-secondary {
    min-height: 44px;

    padding:
        0 18px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    border-radius: 9px;

    font-size: 13px;
    font-weight: 700;

    text-decoration: none;

    transition:
        background .18s ease,
        transform .18s ease,
        box-shadow .18s ease;
}


.resident-home-primary {
    background: #0b8478;

    color: #ffffff;

    box-shadow:
        0 7px 18px
        rgba(11, 132, 120, .16);
}


.resident-home-primary:hover {
    background: #08756b;

    color: #ffffff;

    transform:
        translateY(-1px);
}


.resident-home-secondary {
    background: #ffffff;

    border:
        1px solid #dce7e5;

    color: #475569;
}


.resident-home-secondary:hover {
    background: #f8fbfa;

    color: #334155;
}


/* =========================================================
   HERO IMAGE
========================================================= */

.resident-home-visual {
    position: relative;

    min-height: 220px;

    overflow: hidden;
}


.resident-home-visual > img {
    position: absolute;

    inset: 0;

    width: 100%;
    height: 100%;

    object-fit: cover;

    object-position: center;
}


.resident-home-visual-overlay {
    position: absolute;

    inset: 0;

    background:
        linear-gradient(
            90deg,
            rgba(255, 255, 255, .78),
            rgba(255, 255, 255, .12)
        );
}


.resident-home-badge {
    position: absolute;

    right: 20px;
    bottom: 18px;

    padding:
        10px 13px;

    display: flex;
    align-items: center;

    gap: 10px;

    background:
        rgba(255, 255, 255, .93);

    border:
        1px solid
        rgba(255, 255, 255, .86);

    border-radius: 11px;

    box-shadow:
        0 8px 24px
        rgba(15, 23, 42, .08);

    backdrop-filter:
        blur(10px);
}


.resident-home-badge-logo {
    width: 36px;
    height: 36px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f9bd3b;

    border-radius: 9px;

    color: #07584f;

    font-size: 12px;
    font-weight: 800;
}


.resident-home-badge-copy {
    display: flex;
    flex-direction: column;
}


.resident-home-badge-copy span {
    color: #7f8fa5;

    font-size: 9px;
}


.resident-home-badge-copy strong {
    margin-top: 2px;

    color: #26354e;

    font-size: 11px;
}


/* =========================================================
   SHARED RESIDENT DASHBOARD SECTION
========================================================= */

.resident-home-section {
    overflow: hidden;

    background: #ffffff;

    border:
        1px solid #e2ebe9;

    border-radius: 16px;

    box-shadow:
        0 7px 28px
        rgba(15, 41, 55, .035);
}


.resident-home-section-header {
    min-height: 78px;

    padding:
        16px 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 18px;

    border-bottom:
        1px solid #e9efee;
}


.resident-home-section-heading {
    min-width: 0;

    display: flex;
    align-items: center;

    gap: 12px;
}


.resident-home-section-icon {
    width: 40px;
    height: 40px;

    flex:
        0 0 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #e3f7f3;

    color: #0b8b7d;
}


.resident-home-section-icon svg {
    width: 21px;
    height: 21px;
}


.resident-home-section-copy {
    min-width: 0;
}


.resident-home-section-eyebrow {
    display: block;

    margin-bottom: 3px;

    color: #0b8175;

    font-size: 9px;
    font-weight: 800;

    letter-spacing: 1.3px;

    text-transform: uppercase;
}


.resident-home-section-copy h3 {
    margin: 0;

    color: #17223b;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 17px;
    font-weight: 750;
}


.resident-home-section-copy p {
    margin:
        4px 0 0;

    color: #74839a;

    font-size: 12px;

    line-height: 1.45;
}


.resident-home-view-all {
    min-height: 38px;

    padding:
        0 13px;

    display: inline-flex;
    align-items: center;

    gap: 7px;

    border:
        1px solid #dce9e6;

    border-radius: 8px;

    background: #ffffff;

    color: #087d72;

    font-size: 11px;
    font-weight: 700;

    text-decoration: none;
}


.resident-home-view-all:hover {
    background: #f5fbf9;

    color: #066a61;
}


/* =========================================================
   ANNOUNCEMENT CARDS
========================================================= */

.resident-announcement-grid {
    padding:
        17px 18px 19px;

    display: grid;

    grid-template-columns:
        repeat(
            4,
            minmax(0, 1fr)
        );

    gap: 12px;
}


.resident-announcement-card {
    min-width: 0;
    min-height: 180px;

    padding: 16px;

    display: flex;
    flex-direction: column;

    background: #ffffff;

    border:
        1px solid #e7eeed;

    border-radius: 12px;

    transition:
        transform .18s ease,
        box-shadow .18s ease,
        border-color .18s ease;
}


.resident-announcement-card:hover {
    transform:
        translateY(-2px);

    border-color: #cfe3df;

    box-shadow:
        0 8px 22px
        rgba(15, 41, 55, .06);
}


.resident-announcement-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 8px;
}


.resident-announcement-icon {
    width: 39px;
    height: 39px;

    flex:
        0 0 39px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;
}


.resident-announcement-icon svg {
    width: 21px;
    height: 21px;
}


.resident-announcement-category {
    padding:
        5px 9px;

    display: inline-flex;

    border-radius: 999px;

    font-size: 9px;
    font-weight: 700;

    white-space: nowrap;
}


.resident-announcement-card h4 {
    margin:
        13px 0 6px;

    color: #17223b;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 14px;
    font-weight: 750;

    line-height: 1.35;
}


.resident-announcement-card p {
    margin: 0;

    overflow: hidden;

    color: #64748b;

    font-size: 11.5px;

    line-height: 1.55;

    display: -webkit-box;

    -webkit-line-clamp: 3;

    -webkit-box-orient: vertical;
}


.resident-announcement-date {
    margin-top: auto;

    padding-top: 12px;

    display: flex;
    align-items: center;

    gap: 6px;

    color: #7f8fa5;

    font-size: 10px;
    font-weight: 600;
}


.resident-announcement-date svg {
    width: 13px;
    height: 13px;
}


/* =========================================================
   CATEGORY COLORS
========================================================= */

.resident-announcement-icon.community,
.resident-announcement-category.community {
    background: #f0eaff;

    color: #7c3aed;
}


.resident-announcement-icon.youth,
.resident-announcement-category.youth {
    background: #e8f1ff;

    color: #2563eb;
}


.resident-announcement-icon.health,
.resident-announcement-category.health {
    background: #e8f8ee;

    color: #15803d;
}


.resident-announcement-icon.government,
.resident-announcement-category.government {
    background: #fff0dc;

    color: #c56a0a;
}


.resident-announcement-icon.emergency,
.resident-announcement-category.emergency {
    background: #ffe9e9;

    color: #dc2626;
}


.resident-announcement-icon.other,
.resident-announcement-category.other {
    background: #eef2f7;

    color: #64748b;
}


/* =========================================================
   EMPTY ANNOUNCEMENT STATE
========================================================= */

.resident-announcement-empty {
    grid-column:
        1 / -1;

    padding:
        30px;

    text-align: center;

    background: #f8fafb;

    border-radius: 11px;
}


.resident-announcement-empty strong {
    display: block;

    color: #334155;

    font-size: 14px;
}


.resident-announcement-empty span {
    display: block;

    margin-top: 5px;

    color: #8290a5;

    font-size: 12px;
}


/* =========================================================
   RESIDENT SERVICES
========================================================= */

.resident-service-grid {
    padding:
        17px 18px 19px;

    display: grid;

    grid-template-columns:
        repeat(
            3,
            minmax(0, 1fr)
        );

    gap: 13px;
}


.resident-service-card {
    min-height: 115px;

    padding: 16px;

    display: grid;

    grid-template-columns:
        42px
        minmax(0, 1fr)
        18px;

    align-items: center;

    gap: 13px;

    background: #ffffff;

    border:
        1px solid #e6eeec;

    border-radius: 12px;

    color: inherit;

    text-decoration: none;

    transition:
        transform .18s ease,
        border-color .18s ease,
        box-shadow .18s ease;
}


.resident-service-card:hover {
    transform:
        translateY(-2px);

    border-color: #cfe3df;

    box-shadow:
        0 8px 22px
        rgba(15, 41, 55, .055);
}


.resident-service-icon {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #e3f7f3;

    color: #0b887b;
}


.resident-service-icon.blue {
    background: #e8f1ff;

    color: #2563eb;
}


.resident-service-icon.gold {
    background: #fff3da;

    color: #c87a00;
}


.resident-service-icon svg {
    width: 22px;
    height: 22px;
}


.resident-service-copy {
    min-width: 0;
}


.resident-service-copy strong {
    display: block;

    color: #17223b;

    font-size: 13px;
    font-weight: 750;
}


.resident-service-copy span {
    display: block;

    margin-top: 5px;

    color: #718096;

    font-size: 11px;

    line-height: 1.5;
}


.resident-service-arrow {
    color: #8495aa;

    font-size: 19px;
}


/* =========================================================
   ALL ANNOUNCEMENTS PAGE
========================================================= */

.resident-announcements-page {
    width: 100%;

    display: flex;
    flex-direction: column;

    gap: 17px;
}


.resident-announcements-page-header {
    padding:
        21px 22px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    background: #ffffff;

    border:
        1px solid #e2ebe9;

    border-radius: 15px;

    box-shadow:
        0 6px 24px
        rgba(15, 41, 55, .035);
}


.resident-announcements-page-header h2 {
    margin: 0;

    color: #17223b;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 22px;
}


.resident-announcements-page-header p {
    margin:
        6px 0 0;

    color: #718096;

    font-size: 12px;

    line-height: 1.5;
}


.resident-announcements-list {
    display: grid;

    grid-template-columns:
        repeat(
            3,
            minmax(0, 1fr)
        );

    gap: 14px;
}


.resident-announcements-list-card {
    min-height: 225px;

    padding: 19px;

    display: flex;
    flex-direction: column;

    background: #ffffff;

    border:
        1px solid #e2ebe9;

    border-radius: 14px;

    box-shadow:
        0 5px 20px
        rgba(15, 41, 55, .03);
}


.resident-announcements-list-card h3 {
    margin:
        14px 0 8px;

    color: #17223b;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 16px;
}


.resident-announcements-list-card p {
    margin: 0;

    color: #64748b;

    font-size: 12px;

    line-height: 1.65;
}


.resident-announcements-list-footer {
    margin-top: auto;

    padding-top: 17px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 10px;
}


/* =========================================================
   PAGINATION
========================================================= */

.resident-announcement-pagination {
    padding:
        14px 16px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    background: #ffffff;

    border:
        1px solid #e2ebe9;

    border-radius: 12px;

    color: #64748b;

    font-size: 11px;
}


.resident-announcement-pagination-buttons {
    display: flex;

    gap: 6px;
}


.resident-announcement-pagination a,
.resident-announcement-pagination span {
    min-width: 33px;
    height: 33px;

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


.resident-announcement-pagination .active {
    background: #078f7c;

    border-color: #078f7c;

    color: #ffffff;
}


.resident-announcement-pagination .disabled {
    color: #cbd5e1;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1200px) {

    .resident-announcement-grid {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }


    .resident-announcements-list {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }

}


@media (max-width: 950px) {

    .resident-home-hero {
        grid-template-columns:
            1fr 330px;
    }


    .resident-service-grid {
        grid-template-columns:
            1fr;
    }

}


@media (max-width: 760px) {

    .resident-home-hero {
        grid-template-columns: 1fr;
    }


    .resident-home-visual {
        min-height: 180px;
    }


    .resident-announcement-grid,
    .resident-announcements-list {
        grid-template-columns: 1fr;
    }


    .resident-home-section-header,
    .resident-announcements-page-header {
        align-items: flex-start;

        flex-direction: column;
    }

}


@media (max-width: 560px) {

    .resident-home-hero-content {
        padding:
            22px 19px;
    }


    .resident-home-hero-content h2 {
        font-size: 25px;
    }


    .resident-home-hero-description {
        font-size: 13px;
    }


    .resident-home-hero-actions {
        align-items: stretch;

        flex-direction: column;
    }


    .resident-home-primary,
    .resident-home-secondary {
        width: 100%;
    }


    .resident-announcement-grid,
    .resident-service-grid {
        padding:
            14px;
    }


    .resident-announcement-card h4 {
        font-size: 14px;
    }


    .resident-announcement-card p {
        font-size: 12px;
    }


    .resident-service-copy strong {
        font-size: 13px;
    }


    .resident-service-copy span {
        font-size: 11px;
    }

}

</style>