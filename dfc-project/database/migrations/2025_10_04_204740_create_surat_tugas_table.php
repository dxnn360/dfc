<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('surat_tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // analis yang membuat
            $table->date('tanggal');
            $table->string('sumber_permintaan');
            $table->text('ringkasan_kasus');
            $table->string('nama_pemohon');
            $table->string('nomor_surat')->unique();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_supervisor')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Pivot untuk relasi banyak user (ahli/supervisor)
        Schema::create('surat_tugas_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_tugas_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('surat_tugas_id')->references('id')->on('surat_tugas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_tugas');
    }
};
