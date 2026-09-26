<?php

namespace App\Http\Requests\Admin;

use App\Models\Galeri;
use Illuminate\Validation\Rule;

class GaleriRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:150'],
            'kategori' => ['required', Rule::in(Galeri::KATEGORI)],
            'tahun' => ['required', 'integer', 'between:1990,'.(date('Y') + 1)],
            'angkatan_id' => ['nullable', 'exists:angkatan,id'],
            'deskripsi' => ['nullable', 'string', 'max:2000'],
            'foto' => $this->imageRule($this->isMethod('post')),
        ];
    }
}
