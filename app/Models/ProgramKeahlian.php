<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class ProgramKeahlian extends Model
{
    use HasImageUrl;

    protected $table = 'program_keahlian';
    protected $guarded = [];
    protected string $imageColumn = 'hero_image';

    public function kepala(): HasOne { return $this->hasOne(Profil::class); }
    public function sejarah(): HasOne { return $this->hasOne(Sejarah::class); }
    public function laboratorium(): HasMany { return $this->hasMany(Laboratorium::class); }
}
