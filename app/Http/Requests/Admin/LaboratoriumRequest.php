<?php

namespace App\Http\Requests\Admin;

class LaboratoriumRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string', 'max:3000'],
            'kapasitas' => ['required', 'integer', 'min:0', 'max:500'],
            'lokasi' => ['nullable', 'string', 'max:150'],
            'fasilitas' => ['nullable', 'string', 'max:2000'],
            'jadwal' => ['nullable', 'string', 'max:2000'],
            'status' => ['required', 'in:aktif,perawatan,nonaktif'],
            'foto' => $this->imageRule(),
        ];
    }
}
