<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistik', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->unsignedInteger('nilai')->default(0);
            $table->string('ikon')->nullable();
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->boolean('tampil')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistik');
    }
};
