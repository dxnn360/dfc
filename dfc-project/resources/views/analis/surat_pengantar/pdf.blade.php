<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Surat Pengantar</title>
  <style>
    /* ====== SETTING HALAMAN ====== */
    @page {
      size: A4;
      margin: 10mm 20mm 25mm 20mm;
    }

    body {
      font-family: "Calibri", sans-serif !important;
      font-size: 10pt;
      line-height: 1.4;
      color: #000;
      margin: 0;
      padding: 0;
      text-align: justify;
    }

    /* ====== HEADER ====== */
    .a4-header {
      text-align: center;
      margin-bottom: 15px;
    }

    /* ====== BODY ====== */
    .a4-body {
      margin-top: 10px;
      margin-bottom: 60px;
    }

    /* Biarkan konten Summernote ikut style */
    .a4-body * {
      font-family: inherit !important;
      font-size: inherit !important;
      line-height: 1.4 !important;
      color: #000 !important;
    }

    /* Paragraf */
    .a4-body p,
    .a4-body div {
      margin: 0 0 6pt 0;
    }

    /* Hapus <p><br></p> dari Summernote */
    .a4-body p:empty,
    .a4-body p:has(br:only-child) {
      display: none;
    }

    /* ====== FOOTER ====== */
    .a4-footer {
      text-align: center;
      font-size: 10pt;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
    }

    /* ====== TABEL ====== */
    .preview-table {
      width: 100%;
      border-collapse: collapse;
      margin: 10px 0 20px 0;
      font-size: 11pt;
      border: 1px solid #000;
    }

    .preview-table th,
    .preview-table td {
      border: 1px solid #000;
      padding: 6px 8px;
      vertical-align: middle;
    }

    .preview-table th {
      background-color: #f2f2f2;
      font-weight: bold;
      text-align: center;
    }

    /* Baris selang-seling */
    .preview-table tr:nth-child(even) {
      background-color: #fafafa;
    }

    /* Perbaikan penting — biar gak kosong halaman 1 */
    .table-wrapper {
      page-break-before: auto !important;
      page-break-after: auto !important;
      page-break-inside: avoid !important;
      display: block;
      margin-top: 10px;
      margin-bottom: 20px;
    }

    /* Biar tabel header muncul di halaman baru */
    thead {
      display: table-header-group;
    }

    /* Kolom kecil rata tengah */
    .preview-table td:nth-child(1),
    .preview-table td:nth-child(3) {
      text-align: center;
    }

    /* ====== CETAK ====== */
    @media print {
      .a4-header {
        display: none;
      }

      .a4-header:first-of-type {
        display: block;
      }
    }
  </style>
</head>

<body>
  <div class="a4-header">
    {!! $header !!}
  </div>

  <div class="a4-body">
    {!! $body !!}
  </div>

  <div class="a4-footer">
    {!! $footer !!}
  </div>
</body>

</html>
