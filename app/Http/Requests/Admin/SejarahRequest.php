<?php

namespace App\Http\Requests\Admin;

class SejarahRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:150'],
            'narasi' => ['nullable', 'string', 'max:20000'],
        ];
    }
}
