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
        Schema::create('laporan_penyelidikan', function (Blueprint $table) {
            $table->id();

            // Relasi ke user
            $table->unsignedBigInteger('user_id');
            $table->string('nomor_surat')->unique();

            // Info dasar
            $table->date('tanggal')->nullable();
            $table->string('nama_pemohon')->nullable();
            $table->string('jabatan_pemohon')->nullable();

            // Konten laporan
            $table->text('informasi_pemeriksaan')->nullable();
            $table->json('barang_bukti')->nullable();   // array
            $table->text('tujuan_pemeriksaan')->nullable();
            $table->text('metodologi')->nullable();
            $table->json('sumber')->nullable();        // array {jenis, penjelasan}
            $table->text('hasil_pemeriksaan')->nullable();
            $table->text('kesimpulan')->nullable();

            // Supervisor
            $table->text('catatan_supervisor')->nullable();
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('draft');

            $table->timestamps();

            // Foreign key ke users
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_penyelidikan');
    }
};
