<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Timeline extends Model
{
    use HasImageUrl;

    protected $table = 'timeline';
    protected $guarded = [];
    protected string $imageColumn = 'foto';

    public function sejarah(): BelongsTo { return $this->belongsTo(Sejarah::class); }
}
