<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LaboratoriumRequest;
use App\Models\Laboratorium;
use App\Models\ProgramKeahlian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LaboratoriumController extends ResourceController
{
    protected function model(): string { return Laboratorium::class; }
    protected function request(): string { return LaboratoriumRequest::class; }
    protected function view(): string { return 'admin.laboratorium'; }
    protected function routeName(): string { return 'admin.laboratorium'; }

    protected array $images = ['foto' => 'laboratorium'];
    protected array $searchable = ['nama', 'lokasi'];
    protected array $filterable = ['status'];

    protected function payload(array $data, ?Model $item): array
    {
        $data['program_keahlian_id'] = ProgramKeahlian::firstOrFail()->id;
        $data['slug'] = $this->uniqueSlug($data['nama'], $item);

        foreach (['fasilitas', 'jadwal'] as $field) { // textarea: satu item per baris
            $data[$field] = collect(preg_split('/\R/', (string) ($data[$field] ?? '')))
                ->map(fn ($line) => trim($line))->filter()->values()->all();
        }

        return $data;
    }

    private function uniqueSlug(string $nama, ?Model $item): string
    {
        $base = $slug = Str::slug($nama);
        $i = 2;
        while (Laboratorium::withTrashed()->where('slug', $slug)->when($item, fn ($q) => $q->whereKeyNot($item->id))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
