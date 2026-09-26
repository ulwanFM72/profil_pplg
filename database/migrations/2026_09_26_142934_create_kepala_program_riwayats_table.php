<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kepala_program_riwayats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_keahlian_id')->constrained('program_keahlian')->cascadeOnDelete();
            $table->string('nama');
            $table->string('gelar')->nullable();
            $table->unsignedSmallInteger('periode_mulai');
            $table->unsignedSmallInteger('periode_selesai')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kepala_program_riwayats');
    }
};
