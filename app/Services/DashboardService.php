<?php

namespace App\Services;

use App\Models\{Angkatan, Asset, Galeri, Laboratorium, ProgramKeahlian};

class DashboardService
{
    public function summary(): array
    {
        $program = ProgramKeahlian::first();

        return [
            'cards' => [
                'Laboratorium' => Laboratorium::count(),
                'Asset' => (int) Asset::sum('jumlah'),
                'Galeri' => Galeri::count(),
                'Angkatan' => Angkatan::count(),
                'Guru' => $program?->jumlah_guru ?? 0,
                'Siswa' => $program?->jumlah_siswa ?? 0,
            ],
            'galeriPerTahun' => Galeri::selectRaw('tahun, count(*) as total')->groupBy('tahun')->orderBy('tahun')->pluck('total', 'tahun'),
            'assetPerKategori' => Asset::selectRaw('kategori, sum(jumlah) as total')->groupBy('kategori')->pluck('total', 'kategori'),
        ];
    }
}
