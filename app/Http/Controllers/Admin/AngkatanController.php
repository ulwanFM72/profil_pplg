<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AngkatanRequest;
use App\Models\Angkatan;

class AngkatanController extends ResourceController
{
    protected function model(): string { return Angkatan::class; }
    protected function request(): string { return AngkatanRequest::class; }
    protected function view(): string { return 'admin.angkatan'; }
    protected function routeName(): string { return 'admin.angkatan'; }

    protected array $images = ['foto' => 'angkatan'];
    protected array $searchable = ['nama'];
    protected string $orderBy = 'tahun';
}
