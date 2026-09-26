<?php

namespace App\Http\Requests\Admin;

use App\Models\Asset;
use Illuminate\Validation\Rule;

class AssetRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:150'],
            'kategori' => ['required', Rule::in(Asset::KATEGORI)],
            'laboratorium_id' => ['nullable', 'exists:laboratorium,id'],
            'jumlah' => ['required', 'integer', 'min:0', 'max:100000'],
            'kondisi' => ['required', 'in:baik,cukup,rusak'],
            'tahun_pengadaan' => ['nullable', 'integer', 'between:1990,'.(date('Y') + 1)],
            'deskripsi' => ['nullable', 'string', 'max:2000'],
            'foto' => $this->imageRule(),
        ];
    }
}
