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
        Schema::create('document_templates', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['surat_tugas', 'surat_pengantar', 'laporan_penyelidikan']);
            $table->text('header')->nullable();
            $table->text('footer')->nullable();
            $table->string('logo')->nullable();
            $table->string('format_tanggal')->default('d F Y');
            $table->string('nomor_format')->nullable(); // contoh: ST-[0001]/IX/2025
            $table->longText('body')->nullable(); // isi template pakai CKEditor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_templates');
    }
};
