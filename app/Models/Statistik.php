<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Statistik extends Model
{
    use HasImageUrl;

    protected $table = 'statistik';
    protected $guarded = [];
    protected string $imageColumn = 'ikon';
    protected $casts = ['tampil' => 'boolean'];

    public function scopeTampil($q) { return $q->where('tampil', true)->orderBy('urutan'); }
}
