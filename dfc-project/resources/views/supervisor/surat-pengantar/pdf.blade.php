<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Tugas</title>
    <style>
        @page {
            size: A4;
            margin: 10mm 20mm 20mm 20mm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            line-height: 1.0;
        }

        .a4-header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .a4-body {
            text-align: justify;
            margin-bottom: 40px;
        }

        .a4-footer {
            text-align: center;
            border-top: 1px solid #000;
            padding-top: 10px;
            font-size: 10pt;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .preview-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 11pt;
        }

        .preview-table th,
        .preview-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        .preview-table th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <div class="a4-header">{!! $header !!}</div>
    <div class="a4-body">{!! $body !!}</div>
    <div class="a4-footer">{!! $footer !!}</div>
</body>

</html>