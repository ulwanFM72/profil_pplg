<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AssetRequest;
use App\Models\Asset;
use App\Models\Laboratorium;

class AssetController extends ResourceController
{
    protected function model(): string { return Asset::class; }
    protected function request(): string { return AssetRequest::class; }
    protected function view(): string { return 'admin.asset'; }
    protected function routeName(): string { return 'admin.asset'; }

    protected array $images = ['foto' => 'asset'];
    protected array $searchable = ['nama', 'deskripsi'];
    protected array $filterable = ['kategori', 'kondisi'];

    protected function formData(): array
    {
        return ['kategoriList' => Asset::KATEGORI, 'labs' => Laboratorium::orderBy('nama')->pluck('nama', 'id')];
    }
}
