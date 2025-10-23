<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Surat Tugas</title>
  <style>
    /* === Halaman A4 === */
    @page {
      size: A4;
      margin: 10mm 20mm 20mm 20mm;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: "Times New Roman", serif;
      font-size: 12pt;
      line-height: 1.5;
      color: #000;
      text-align: justify;
    }

    /* === HEADER === */
    .a4-header {
      text-align: center;
      margin-bottom: 0px;
    }

    .a4-header img {
      width: 100%;
      max-height: auto;
      object-fit: cover;
      display: block;
      margin: 0 auto;
    }

    /* === FOOTER === */
    .a4-footer {
      text-align: center;
      font-size: 10pt;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
    }

    .a4-footer img {
      width: 100%;
      max-height: 50px;
      object-fit: contain;
      display: block;
      margin: 0 auto;
    }

    /* === BODY === */
    .a4-body {
      margin-top: 0;
      margin-bottom: 60px;
      font-family: "Times New Roman", serif !important;
      font-size: 12pt !important;
      line-height: 1.5 !important;
      color: #000 !important;
      word-break: break-word;
      overflow-wrap: break-word;
      white-space: normal;
    }

    /* Override font Summernote tanpa mengubah layout */
    .a4-body * {
      font-family: inherit !important;
      font-size: inherit !important;
      line-height: inherit !important;
      color: inherit !important;
      word-break: break-word;
      overflow-wrap: break-word;
      white-space: normal;
    }

    /* Hilangkan paragraf kosong dari Summernote */
    .a4-body p:empty,
    .a4-body p:has(br:only-child) {
      display: none;
    }

    /* Margin antar paragraf rapat */
    .a4-body p + p {
      margin-top: 2pt;
    }

    /* Bold & italic tetap */
    .a4-body b,
    .a4-body strong {
      font-weight: bold;
    }

    .a4-body i,
    .a4-body em {
      font-style: italic;
    }

    /* === TABEL === */
    .a4-body table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
      margin: 10px 0;
      font-size: 11pt;
      page-break-inside: auto;
    }

    .a4-body th,
    .a4-body td {
      border: 1px solid #000;
      padding: 6px 8px;
      vertical-align: top;
      word-break: break-word;
      overflow-wrap: break-word;
      white-space: normal;
    }

    .a4-body th {
      background-color: #f0f0f0;
      font-weight: bold;
      text-align: center;
    }

    .a4-body tr:nth-child(even) {
      background-color: #fafafa;
    }

    /* Kolom kecil seperti no & jumlah rata tengah */
    .a4-body td:nth-child(1),
    .a4-body td:nth-child(3),
    .a4-body td:nth-child(4) {
      text-align: center;
    }

    /* Header tabel tetap muncul jika pecah halaman */
    thead {
      display: table-header-group;
    }

    tfoot {
      display: table-row-group;
    }

    /* Page break untuk body */
    .a4-body * {
      page-break-inside: auto;
    }

    .a4-body table,
    .a4-body tr,
    .a4-body td {
      page-break-inside: avoid;
    }
  </style>
</head>

<body>
  <!-- HEADER -->
  <div class="a4-header">
    {!! $header !!}
  </div>

  <!-- BODY -->
  <div class="a4-body">
    {!! $body !!}
  </div>

  <!-- FOOTER -->
  <div class="a4-footer">
    {!! $footer !!}
  </div>
</body>

</html>
