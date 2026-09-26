<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Galeri extends Model
{
    use HasImageUrl, SoftDeletes;

    protected $table = 'galeri';
    protected $guarded = [];
    protected string $imageColumn = 'foto';
    public const KATEGORI = ['Angkatan', 'Kegiatan', 'Praktik', 'Lomba', 'Kunjungan Industri', 'Event', 'Lainnya'];

    public function angkatan(): BelongsTo { return $this->belongsTo(Angkatan::class); }
    public function scopeFilter($q, array $f) {
        return $q->when($f['kategori'] ?? null, fn ($q, $v) => $q->where('kategori', $v))
                 ->when($f['tahun'] ?? null, fn ($q, $v) => $q->where('tahun', $v))
                 ->when($f['q'] ?? null, fn ($q, $v) => $q->where('judul', 'like', "%$v%"));
    }
}
