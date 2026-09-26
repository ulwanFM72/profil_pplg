<?php

namespace Database\Factories;

use App\Models\ProgramKeahlian;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LaboratoriumFactory extends Factory
{
    public function definition(): array
    {
        $nama = 'Lab '.fake()->unique()->word();

        return [
            'program_keahlian_id' => ProgramKeahlian::factory(),
            'nama' => $nama,
            'slug' => Str::slug($nama).'-'.fake()->unique()->numberBetween(1, 99999),
            'deskripsi' => fake()->paragraph(),
            'kapasitas' => 30,
            'lokasi' => 'Gedung A',
            'status' => 'aktif',
        ];
    }
}
