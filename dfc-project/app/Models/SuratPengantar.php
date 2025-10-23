<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengantar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'tanggal',
        'nama_pemohon',
        'jabatan_pemohon',
        'klasifikasi',
        'barang_bukti',
        'sumber_permohonan',
        'alamat',
        'status',
        'catatan_supervisor',
        'user_id',
    ];

    protected $casts = [
        'barang_bukti' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
