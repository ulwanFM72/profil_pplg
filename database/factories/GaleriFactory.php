<?php

namespace Database\Factories;

use App\Models\Galeri;
use Illuminate\Database\Eloquent\Factories\Factory;

class GaleriFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul' => fake()->sentence(3),
            'foto' => 'galeri/placeholder.jpg',
            'kategori' => fake()->randomElement(Galeri::KATEGORI),
            'tahun' => fake()->numberBetween(2020, 2026),
        ];
    }
}
