<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // analis yang buat
            $table->enum('type', ['surat_tugas', 'surat_pengantar', 'laporan_penyelidikan']);
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('sumber_permintaan')->nullable();
            $table->text('ringkasan_kasus')->nullable();
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('draft');
            $table->text('catatan_supervisor')->nullable();
            $table->timestamps();
        });

        Schema::create('document_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_user');
        Schema::dropIfExists('documents');
    }
};
