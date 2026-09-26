<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_keahlian', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kompetensi');
            $table->string('tagline')->nullable();
            $table->text('deskripsi')->nullable();
            $table->year('tahun_berdiri')->nullable();
            $table->string('akreditasi', 5)->nullable();
            $table->unsignedInteger('jumlah_guru')->default(0);
            $table->unsignedInteger('jumlah_siswa')->default(0);
            $table->string('logo')->nullable();
            $table->string('hero_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_keahlian');
    }
};
