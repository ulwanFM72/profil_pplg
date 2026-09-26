<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Sejarah extends Model
{
    use HasImageUrl;

    protected $table = 'sejarah';
    protected $guarded = [];
    protected string $imageColumn = 'foto';

    public function timeline(): HasMany { return $this->hasMany(Timeline::class)->orderBy('urutan')->orderBy('tahun'); }
}
