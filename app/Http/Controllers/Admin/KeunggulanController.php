<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\KeunggulanRequest;
use App\Models\Keunggulan;

class KeunggulanController extends ResourceController
{
  protected function model(): string
  {
    return Keunggulan::class;
  }
  protected function request(): string
  {
    return KeunggulanRequest::class;
  }
  protected function view(): string
  {
    return 'admin.keunggulan';
  }
  protected function routeName(): string
  {
    return 'admin.keunggulan';
  }

  protected array $images = [];
  protected array $searchable = ['judul', 'teks'];
  protected array $filterable = ['aktif'];
  protected string $orderBy = 'urutan';
  protected string $direction = 'asc';
}
