<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penyelidikan</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: 'Calibri', serif;
            font-size: 12pt;
            line-height: 1.5;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        .a4-container {
            width: 100%;
            min-height: 297mm;
            display: block;
        }

        .a4-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .a4-body {
            margin-bottom: 60px;
            /* kasih space biar ga ketutup footer */
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Footer fixed di tiap halaman */
        .a4-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            text-align: center;
            font-size: 10pt;
            border-top: 1px solid #000;
            padding-top: 5px;
        }

        table {
            width: 100% !important;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
            word-wrap: break-word;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

</head>

<body>

    <div class="a4-container">
        <div class="a4-header">
            {!! $header !!}
        </div>

        <div class="a4-body">
            {!! $body !!}
        </div>
    </div>

    <div class="a4-footer">
        {!! $footer ?? 'Confidential - DFC' !!}
    </div>

</body>

</html>