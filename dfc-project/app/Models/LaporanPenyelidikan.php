<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPenyelidikan extends Model
{
    protected $table = 'laporan_penyelidikan';

    protected $fillable = [
        'user_id',
        'nomor_surat',
        'pekerjaan',
        'organisasi',
        'sumber_permintaan',
        'no_telp',
        'tanggal',
        'nama_pemohon',
        'jabatan_pemohon',
        'informasi_pemeriksaan',
        'barang_bukti',
        'tujuan_pemeriksaan',
        'metodologi',
        'sumber',
        'hasil_pemeriksaan',
        'kesimpulan',
        'catatan_supervisor',
        'status',
    ];

    protected $casts = [
        'barang_bukti' => 'array',
        'sumber'       => 'array',
    ];
}
