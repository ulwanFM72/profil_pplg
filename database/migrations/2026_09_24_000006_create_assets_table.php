<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratorium_id')->nullable()->constrained('laboratorium')->nullOnDelete();
            $table->string('nama');
            $table->string('kategori')->index();
            $table->string('foto')->nullable();
            $table->unsignedInteger('jumlah')->default(1);
            $table->enum('kondisi', ['baik', 'cukup', 'rusak'])->default('baik');
            $table->year('tahun_pengadaan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
