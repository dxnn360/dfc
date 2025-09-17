<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentTemplate;

class DocumentTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'type' => 'surat_tugas',
                'header' => '<div style="text-align:center;">
                                <img src="{{logo}}" alt="Logo" style="height:60px;"><br>
                                <h3>INSTANSI XYZ</h3>
                                <p>Jl. Contoh No. 123, Jakarta</p>
                             </div>',
                'footer' => '<div style="text-align:center; font-size:12px;">
                                <hr>
                                <p>Surat Tugas ini bersifat resmi, harap digunakan sebagaimana mestinya</p>
                             </div>',
                'logo'   => null,
                'format_tanggal' => 'd F Y',
                'nomor_format' => 'ST/{{nomor}}/IX/{{tahun}}',
                'body' => '
                    <h2 style="text-align:center;">SURAT TUGAS</h2>
                    <p>Nomor: {{nomor_surat}}</p>
                    <p>Yang bertanda tangan di bawah ini memberikan tugas kepada:</p>
                    <p><b>{{nama}}</b>, Jabatan: {{jabatan}}, NIP/NIK: {{nip}}</p>
                    <p>Untuk melaksanakan tugas sesuai dengan sumber permintaan: {{sumber_permintaan}}.</p>
                    <p>Ringkasan Kasus: {{ringkasan_kasus}}</p>
                    <p>Ditetapkan di {{lokasi}}, pada tanggal {{tanggal}}</p>
                '
            ],
            [
                'type' => 'surat_pengantar',
                'header' => '<div style="text-align:center;">
                                <img src="{{logo}}" alt="Logo" style="height:60px;"><br>
                                <h3>INSTANSI XYZ</h3>
                                <p>Jl. Contoh No. 123, Jakarta</p>
                             </div>',
                'footer' => '<div style="text-align:center; font-size:12px;">
                                <hr>
                                <p>Surat ini tidak memerlukan tanda tangan basah</p>
                             </div>',
                'logo'   => null,
                'format_tanggal' => 'd F Y',
                'nomor_format' => 'SP/{{nomor}}/IX/{{tahun}}',
                'body' => '
                    <h2 style="text-align:center;">SURAT PENGANTAR</h2>
                    <p>Nomor: {{nomor_surat}}</p>
                    <p>Tanggal: {{tanggal}}</p>
                    <p>Kepada: {{data_pemohon}}</p>
                    <p>Sehubungan dengan surat permintaan nomor {{nomor_surat_permintaan}} dengan klasifikasi {{klasifikasi_surat}}.</p>
                    <p>Barang Bukti: {{barang_bukti}}</p>
                    <p>Demikian surat pengantar ini dibuat.</p>
                '
            ],
            [
                'type' => 'laporan_penyelidikan',
                'header' => '<div style="text-align:center;">
                                <img src="{{logo}}" alt="Logo" style="height:60px;"><br>
                                <h3>INSTANSI XYZ</h3>
                                <p>Jl. Contoh No. 123, Jakarta</p>
                             </div>',
                'footer' => '<div style="text-align:center; font-size:12px;">
                                <hr>
                                <p>Halaman {{page}} dari {{total_pages}}</p>
                             </div>',
                'logo'   => null,
                'format_tanggal' => 'd F Y',
                'nomor_format' => 'LP/{{nomor}}/IX/{{tahun}}',
                'body' => '
                    <h2 style="text-align:center;">LAPORAN PENYELIDIKAN</h2>
                    <p><b>Informasi Pemeriksaan:</b> {{informasi_pemeriksaan}}</p>
                    <p><b>Nama Pemohon:</b> {{nama_pemohon}}</p>
                    <p><b>Unit Kerja Pemohon:</b> {{unit_kerja}}</p>
                    <p><b>Barang Bukti:</b> {{barang_bukti}}</p>
                    <p><b>Tujuan Pemeriksaan:</b> {{tujuan}}</p>
                    <p><b>Metodologi:</b> {{metodologi}}</p>
                    <p><b>Sumber:</b> {{sumber}}</p>
                    <p><b>Hasil Pemeriksaan:</b> {{hasil}}</p>
                    <p><b>Kesimpulan:</b> {{kesimpulan}}</p>
                '
            ],
        ];

        foreach ($templates as $template) {
            DocumentTemplate::updateOrCreate(
                ['type' => $template['type']],
                $template
            );
        }
    }
}
