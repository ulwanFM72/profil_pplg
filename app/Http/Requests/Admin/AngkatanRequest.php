<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

class AngkatanRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'tahun' => ['required', 'integer', 'between:1990,'.(date('Y') + 1), Rule::unique('angkatan', 'tahun')->ignore($this->route('angkatan'))],
            'nama' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string', 'max:2000'],
            'foto' => $this->imageRule(),
        ];
    }
}
