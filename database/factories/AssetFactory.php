<?php

namespace Database\Factories;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => fake()->words(2, true),
            'kategori' => fake()->randomElement(Asset::KATEGORI),
            'jumlah' => fake()->numberBetween(1, 40),
            'kondisi' => 'baik',
            'tahun_pengadaan' => 2023,
        ];
    }
}
