<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laboratorium', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_keahlian_id')->constrained('program_keahlian')->cascadeOnDelete();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->unsignedSmallInteger('kapasitas')->default(0);
            $table->string('lokasi')->nullable();
            $table->json('fasilitas')->nullable();
            $table->json('jadwal')->nullable();
            $table->enum('status', ['aktif', 'perawatan', 'nonaktif'])->default('aktif');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laboratorium');
    }
};
