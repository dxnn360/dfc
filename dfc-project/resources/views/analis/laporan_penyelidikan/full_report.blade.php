<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penyelidikan</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
            font-family: 'Calibri', serif;
        }

        .a4-page {
            min-height: 227mm;
            padding: 10mm;
            margin: 0 auto;
            background: white;
            box-sizing: border-box;
            align-items: center;
        }

        .a4-body {
            min-height: 227mm;
            padding: 20mm;
            display: flex;
            flex-direction: column;
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.6;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
            word-wrap: break-word;
        }

        table th {
            background-color: #f3f3f3;
            font-weight: bold;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        @media print {
            .a4-page {
                page-break-after: always;
            }

            .a4-page:last-child {
                page-break-after: auto;
            }
        }
    </style>
</head>

<body>

    <!-- Halaman 1: Cover -->
    <div class="a4-page">
        <p><strong><span style="font-family:Calibri;font-size:16px;">Pro Justitia</span></strong></p>
        <p><strong><span style="font-family:Calibri;font-size:16px;">BERITA ACARA PEMERIKSAAN FORENSIK
                    DIGITAL</span></strong></p>
        <p><span style="font-family:Calibri;font-size:16px;">&nbsp;</span></p>
        <p style="margin-top: 240px; margin-bottom: 240px; text-align: center;"><img style="align-items: center;"
                src="images/login.png" alt=""></p>
        <p style="text-align:center;"><strong><span style="font-family:Calibri;font-weight:bold;font-size:16px;">DIGITAL
                    FORENSICS CENTER</span></strong></p>
        <p style="text-align:center;"><strong><span
                    style="font-family:Calibri;font-weight:bold;font-size:16px;">UNIVERSITAS MUHAMMADIYAH
                    PURWOKERTO</span></strong></p>
        <p style="text-align:center;"><strong><span
                    style="font-family:Calibri;font-weight:bold;font-size:16px;">{{ isset($laporan->tanggal) ? \Carbon\Carbon::parse($laporan->tanggal)->locale('id')->isoFormat('MMMM YYYY') : '-' }}</span></strong>
        </p>
    </div>

    <!-- Halaman 2: Logo + Alamat + Tabel Informasi -->
    <div class="a4-page" style="margin-bottom: 90px">
        <table>
            <tr>
                <td style="width:70%; vertical-align: top;">
                    <div class="flex">
                        <img src="images/login.png" alt="Logo" style="width:full; height: auto; align-items: right;">
                        <div style="font-size:11px; line-height:1.0; text-align: right;">
                            <p>Lantai 4, Fakultas Teknik dan Sains</p>
                            <p>Universitas Muhammadiyah Purwokerto</p>
                            <p>Jl. KH. Ahmad Dahlan, PO BOX 202 Purwokerto 53182, Kembaran, Banyumas</p>
                            <p>Telp: (0281) 636751, 630463, 634424, Fax: (0281) 637239</p>
                        </div>
                    </div>
                </td>
                <td style="width:30%; text-align:center; vertical-align: middle; font-size:12px">
                    <strong>LAPORAN PEMERIKSAAN PERANGKAT ELEKTRONIK</strong>
                </td>
            </tr>
        </table>

        <table style="margin-top:10px; font-size:12px">
            <tr>
                <th colspan="2" style="background:#d0cece; text-align:center; font-size:12px;">INFORMASI PEMERIKSAAN
                </th>
            </tr>
            <tr>
                <td>Nomor/Tanggal Pemeriksaan</td>
                <td>{{ $laporan->nomor_surat ?? '-' }} /
                    {{ isset($laporan->tanggal) ? \Carbon\Carbon::parse($laporan->tanggal)->locale('id')->isoFormat('DD MMMM YYYY') : '-' }}
                    M</td>
            </tr>
            <tr>
                <td>Jenis Pemeriksaan</td>
                <td>Pemeriksaan Forensik Digital Handphone</td>
            </tr>
            <tr>
                <td>Tempat Pemeriksaan</td>
                <td>DFC UM Purwokerto</td>
            </tr>
        </table>

        <table style="margin-top:10px; font-size:12px">
            <tr>
                <th colspan="4" style="background:#d0cece; text-align:center;">NAMA PEMOHON DAN INFORMASI KONTAK</th>
            </tr>
            <tr>
                <td>Nama</td>
                <td>{{ $laporan->nama_pemohon ?? '-' }}</td>
                <td>Departemen/Unit</td>
                <td>{{ $laporan->jabatan_pemohon ?? '-' }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>{{ $laporan->pekerjaan ?? '-' }}</td>
                <td>Organisasi/Perusahaan</td>
                <td>{{ $laporan->organisasi ?? '-' }}</td>
            </tr>
            <tr>
                <td>No. Telp</td>
                <td>{{ $laporan->no_telp ?? '-' }}</td>
                <td rowspan="2">Nomor Kasus Pemohon</td>
                <td rowspan="2">Surat Nomor {{ $laporan->sumber_permintaan ?? '-' }} tertanggal
                    {{ isset($laporan->tanggal) ? \Carbon\Carbon::parse($laporan->tanggal)->locale('id')->isoFormat('DD MMMM YYYY') : '-' }}
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $laporan->email ?? '-' }}</td>
            </tr>
        </table>

    </div>

    <!-- Halaman 3 dst: Body Laporan -->

    <div class="a4-body" style="word-wrap: break-word; overflow-wrap: break-word;">
        {!! $header !!}
        {!! $body !!}
        {!! $footer !!}
    </div>

</body>

</html>