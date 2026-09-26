<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\GaleriRequest;
use App\Models\Galeri;
use App\Models\Angkatan;

class GaleriController extends ResourceController
{
    protected function model(): string { return Galeri::class; }
    protected function request(): string { return GaleriRequest::class; }
    protected function view(): string { return 'admin.galeri'; }
    protected function routeName(): string { return 'admin.galeri'; }

    protected array $images = ['foto' => 'galeri'];
    protected array $searchable = ['judul'];
    protected array $filterable = ['kategori', 'tahun'];

    protected function formData(): array
    {
        return ['kategoriList' => Galeri::KATEGORI, 'angkatanList' => Angkatan::orderByDesc('tahun')->pluck('nama', 'id')];
    }
}
