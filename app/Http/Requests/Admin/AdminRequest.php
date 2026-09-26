<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

abstract class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /** Sanitasi dasar: buang tag HTML & spasi berlebih (file tidak disentuh). */
    protected function prepareForValidation(): void
    {
        $clean = collect($this->except($this->files->keys()))
            ->map(fn ($v) => is_string($v) ? trim(strip_tags($v)) : $v)
            ->all();

        $this->merge($clean);
    }

    /** Validasi gambar: JPG/JPEG/PNG/WEBP, cek ekstensi + MIME, maks 2 MB. */
    protected function imageRule(bool $required = false): array
    {
        return [$required ? 'required' : 'nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'mimetypes:image/jpeg,image/png,image/webp', 'max:2048'];
    }
}
