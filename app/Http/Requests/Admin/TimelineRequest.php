<?php

namespace App\Http\Requests\Admin;

class TimelineRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'tahun' => ['required', 'integer', 'between:1950,2100'],
            'judul' => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'urutan' => ['nullable', 'integer', 'min:0', 'max:1000'],
        ];
    }
}
