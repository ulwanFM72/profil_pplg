<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Profil extends Model
{
    use HasImageUrl;

    protected $table = 'profil';
    protected $guarded = [];
    protected string $imageColumn = 'foto';

    public function program(): BelongsTo { return $this->belongsTo(ProgramKeahlian::class, 'program_keahlian_id'); }
}
