<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Laboratorium extends Model
{
    use HasImageUrl, SoftDeletes;

    protected $table = 'laboratorium';
    protected $guarded = [];
    protected string $imageColumn = 'foto';
    protected $casts = ['fasilitas' => 'array', 'jadwal' => 'array'];

    public function assets(): HasMany { return $this->hasMany(Asset::class); }
    public function scopeAktif($q) { return $q->where('status', 'aktif'); }
    public function getRouteKeyName(): string { return 'slug'; }
}
