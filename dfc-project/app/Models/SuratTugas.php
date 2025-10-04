<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    use HasFactory;

    protected $table = 'surat_tugas';

    protected $fillable = [
        'user_id',
        'tanggal',
        'sumber_permintaan',
        'ringkasan_kasus',
        'nama_pemohon',
        'nomor_surat',
        'status',
        'catatan_supervisor',
    ];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'surat_tugas_user');
    }
}
