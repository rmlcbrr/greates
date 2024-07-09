<style type="text/css">
    @page {
        size: A4;
        margin: 0;
    }

    @media print {

        html,
        body {
            width: 280mm;
            height: 297mm;
        }

        body {
            display: table;
            table-layout: fixed;
            padding-top: 0cm;
            padding-left: -10cm;
            padding-right: -10cm;
            padding-bottom: 2.5cm;
            height: auto;
        }

        .highlited {
            color: red !important;
            -webkit-print-color-adjust: exact;
        }

        th {
            font-size: 16px;
        }

        td {
            font-size: 14px;
        }

        @page {
            margin: 0;
        }

        * {
            -webkit-print-color-adjust: exact !important;
            /*Chrome, Safari */
            color-adjust: exact !important;
            /*Firefox*/
        }
    }

    @page {
        margin: 0;
    }

    label {
        font-size: 14px;
    }

    table th {
        font-size: 16px;
    }

    td {
        font-size: 14px;
    }

    /* header */
    .conatianer-header {
        padding: 15px;
        text-align: center;
    }

    p.title-header {
        font-size: 30px;
        font-weight: 600;
    }

    p.title-header {
        margin-top: 27px;
    }

    p.ref-no {
        font-size: 20px;
        font-weight: 500;
    }

    span.ref-no-num {
        font-size: 20px;
        font-weight: 500;
        color: red;
    }

    img.left-logo {
        float: left;
        width: 110px;
    }

    img.right-logo {
        float: right;
        width: 110px;
    }
</style>