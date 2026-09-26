<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Storage;

/**
 * Menyediakan accessor `image_url` dari kolom gambar model.
 * Model cukup mendefinisikan $imageColumn dan $imageDir.
 */
trait HasImageUrl
{
    public function getImageUrlAttribute(): ?string
    {
        $path = $this->{$this->imageColumn};

        return $path ? Storage::disk('public')->url($path) : null;
    }
}
