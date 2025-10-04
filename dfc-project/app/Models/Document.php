<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'nomor_surat', 'tanggal',
        'sumber_permintaan', 'ringkasan_kasus', 'nama_pemohon',
        'status', 'catatan_supervisor', 'jabatan_pemohon', 'klasifikasi', 'barang_bukti'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'document_user')
                    ->withTimestamps();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

