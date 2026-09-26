<?php

namespace App\Http\Requests\Admin;

class ProfilRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:150'],
            'kompetensi' => ['required', 'string', 'max:200'],
            'tagline' => ['nullable', 'string', 'max:200'],
            'deskripsi' => ['nullable', 'string', 'max:5000'],
            'tahun_berdiri' => ['nullable', 'integer', 'between:1950,'.date('Y')],
            'akreditasi' => ['nullable', 'in:A,B,C'],
            'jumlah_guru' => ['required', 'integer', 'min:0', 'max:1000'],
            'jumlah_siswa' => ['required', 'integer', 'min:0', 'max:10000'],
            'logo' => $this->imageRule(),
            'hero_image' => $this->imageRule(),
            'kepala_nama' => ['required', 'string', 'max:150'],
            'kepala_gelar' => ['nullable', 'string', 'max:100'],
            'kepala_jabatan' => ['nullable', 'string', 'max:100'],
            'kepala_deskripsi' => ['nullable', 'string', 'max:2000'],
            'kepala_foto' => $this->imageRule(),
        ];
    }
}
