<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StatistikRequest;
use App\Models\Statistik;
use Illuminate\Database\Eloquent\Model;

class StatistikController extends ResourceController
{
    protected function model(): string { return Statistik::class; }
    protected function request(): string { return StatistikRequest::class; }
    protected function view(): string { return 'admin.statistik'; }
    protected function routeName(): string { return 'admin.statistik'; }

    protected array $searchable = ['label'];
    protected string $orderBy = 'urutan';
    protected string $direction = 'asc';

    protected function payload(array $data, ?Model $item): array
    {
        $data['urutan'] = $data['urutan'] ?? 0;

        return $data;
    }
}
