<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentTemplate extends Model
{
    protected $fillable = [
        'type',
        'header',
        'footer',
        'logo',
        'format_tanggal',
        'nomor_format',
        'body',
    ];
}
