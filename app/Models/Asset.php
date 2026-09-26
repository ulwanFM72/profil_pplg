<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Asset extends Model
{
    use HasImageUrl, SoftDeletes;

    protected $table = 'assets';
    protected $guarded = [];
    protected string $imageColumn = 'foto';
    public const KATEGORI = ['Komputer', 'Jaringan', 'Multimedia', 'Praktik', 'Peralatan', 'Lainnya'];

    public function laboratorium(): BelongsTo { return $this->belongsTo(Laboratorium::class); }
}
