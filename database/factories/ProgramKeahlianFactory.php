<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramKeahlianFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => 'Rekayasa Perangkat Lunak',
            'kompetensi' => 'Pengembangan Perangkat Lunak dan Gim',
            'tagline' => fake()->sentence(),
            'deskripsi' => fake()->paragraph(),
            'tahun_berdiri' => 2005,
            'akreditasi' => 'A',
            'jumlah_guru' => 12,
            'jumlah_siswa' => 300,
        ];
    }
}
