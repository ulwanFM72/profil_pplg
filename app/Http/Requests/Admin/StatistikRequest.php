<?php

namespace App\Http\Requests\Admin;

class StatistikRequest extends AdminRequest
{
    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();
        $this->merge(['tampil' => $this->boolean('tampil')]);
    }

    public function rules(): array
    {
        return [
            'label' => ['required', 'string', 'max:60'],
            'nilai' => ['required', 'integer', 'min:0', 'max:1000000'],
            'ikon' => ['nullable', 'string', 'max:50'],
            'urutan' => ['nullable', 'integer', 'min:0', 'max:100'],
            'tampil' => ['boolean'],
        ];
    }
}
