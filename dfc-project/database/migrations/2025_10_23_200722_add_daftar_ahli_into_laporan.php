<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan_penyelidikan', function (Blueprint $table) {
            $table->longText('barang_bukti')->change();
            $table->longText('sumber')->change();
            $table->longText('hasil_pemeriksaan')->change();
            $table->longText('kesimpulan')->change();
        });
    }

    public function down(): void
    {
        Schema::table('laporan_penyelidikan', function (Blueprint $table) {
            $table->text('barang_bukti')->change();
            $table->text('sumber')->change();
            $table->text('hasil_pemeriksaan')->change();
            $table->text('kesimpulan')->change();
        });
    }
};
