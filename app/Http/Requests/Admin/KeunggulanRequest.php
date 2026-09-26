<?php

namespace App\Http\Requests\Admin;

class KeunggulanRequest extends AdminRequest
{
  public function rules(): array
  {
    return [
      'judul' => ['required', 'string', 'max:150'],
      'teks' => ['required', 'string', 'max:500'],
      'warna' => ['required', 'in:bg-sun,bg-sky,bg-leaf,bg-brand text-white'],
      'urutan' => ['nullable', 'integer', 'min:0'],
      'aktif' => ['required', 'in:1,0'],
    ];
  }
}
