<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('laporan_penyelidikan', function (Blueprint $table) {
            $table->string('status_barang_bukti')->after('organisasi')->default('N/A');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_penyelidikan', function (Blueprint $table) {
            $table->dropColumn('status_barang_bukti');
        });
    }
};
