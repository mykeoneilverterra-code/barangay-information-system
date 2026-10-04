<style>

/* =========================================================
   RESIDENT DASHBOARD — IMPORTANT UPDATE
========================================================= */

.resident-attention-section {
    width: 100%;

    overflow: hidden;

    background: #ffffff;

    border: 1px solid #e2ebe9;
    border-radius: 16px;

    box-shadow:
        0 7px 28px
        rgba(15, 41, 55, 0.035);
}


/* =========================================================
   HEADING
========================================================= */

.resident-attention-heading {
    min-height: 76px;

    display: flex;
    align-items: center;

    padding: 17px 22px 13px;
}


.resident-attention-heading-copy span {
    display: block;

    margin-bottom: 4px;

    color: #078b7d;

    font-size: 9px;
    font-weight: 800;

    letter-spacing: 1.4px;

    text-transform: uppercase;
}


.resident-attention-heading-copy h3 {
    margin: 0;

    color: #17223b;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 18px;
    font-weight: 750;

    letter-spacing: -0.35px;
}


/* =========================================================
   ALERT LIST
========================================================= */

.resident-attention-list {
    padding:
        0 22px 20px;

    display: flex;
    flex-direction: column;

    gap: 10px;
}


/* =========================================================
   PICKUP ALERT
========================================================= */

.resident-pickup-alert {
    min-height: 105px;

    display: grid;

    grid-template-columns:
        52px
        minmax(0, 1fr)
        auto;

    align-items: center;

    gap: 16px;

    padding:
        15px 17px;

    background:
        linear-gradient(
            100deg,
            #ecfaf4 0%,
            #f5fcf9 100%
        );

    border:
        1px solid #a9e3cb;

    border-radius: 12px;
}


/* =========================================================
   ICON
========================================================= */

.resident-pickup-icon {
    width: 52px;
    height: 52px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #d5f5e5;

    border-radius: 13px;

    color: #06845f;
}


.resident-pickup-icon::before {
    content: "";

    position: absolute;
}


.resident-pickup-icon svg {
    width: 26px;
    height: 26px;
}


/* =========================================================
   CONTENT
========================================================= */

.resident-pickup-content {
    min-width: 0;
}


.resident-pickup-content h4 {
    margin: 0;

    color: #08603f;

    font-family:
        "Plus Jakarta Sans",
        sans-serif;

    font-size: 14px;
    font-weight: 750;

    line-height: 1.4;
}


.resident-pickup-content p {
    max-width: 850px;

    margin:
        5px 0 0;

    color: #53697d;

    font-size: 11px;

    line-height: 1.55;
}


.resident-pickup-content p strong {
    color: #334a5f;

    font-weight: 700;
}


/* =========================================================
   BUTTON
========================================================= */

.resident-pickup-action {
    min-width: 125px;
    min-height: 41px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    padding:
        0 13px;

    background:
        rgba(
            255,
            255,
            255,
            .85
        );

    border:
        1px solid #83d4b7;

    border-radius: 9px;

    color: #07806f;

    font-size: 10px;
    font-weight: 750;

    text-decoration: none;

    white-space: nowrap;

    transition:
        background .18s ease,
        transform .18s ease,
        border-color .18s ease;
}


.resident-pickup-action svg {
    width: 15px;
    height: 15px;
}


.resident-pickup-action:hover {
    transform: translateY(-1px);

    background: #ffffff;

    border-color: #4cbd98;

    color: #066b5e;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 900px) {

    .resident-pickup-alert {
        grid-template-columns:
            48px
            minmax(0, 1fr);
    }


    .resident-pickup-icon {
        width: 48px;
        height: 48px;
    }


    .resident-pickup-action {
        width: 100%;

        grid-column:
            1 / -1;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 600px) {

    .resident-attention-heading {
        padding:
            16px 16px 12px;
    }


    .resident-attention-heading-copy h3 {
        font-size: 16px;
    }


    .resident-attention-list {
        padding:
            0 16px 16px;
    }


    .resident-pickup-alert {
        grid-template-columns:
            42px
            minmax(0, 1fr);

        gap: 11px;

        padding: 13px;
    }


    .resident-pickup-icon {
        width: 42px;
        height: 42px;

        border-radius: 10px;
    }


    .resident-pickup-icon svg {
        width: 21px;
        height: 21px;
    }


    .resident-pickup-content h4 {
        font-size: 12px;
    }


    .resident-pickup-content p {
        font-size: 10px;
    }


    .resident-pickup-action {
        min-height: 40px;

        grid-column:
            1 / -1;
    }

}

</style>