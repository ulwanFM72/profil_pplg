<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Angkatan extends Model
{
    use HasImageUrl;

    protected $table = 'angkatan';
    protected $guarded = [];
    protected string $imageColumn = 'foto';

    public function galeri(): HasMany { return $this->hasMany(Galeri::class); }
}
