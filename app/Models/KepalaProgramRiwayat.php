<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KepalaProgramRiwayat extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_keahlian_id',
        'nama',
        'gelar',
        'periode_mulai',
        'periode_selesai',
        'keterangan',
        'foto',
        'urutan',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(ProgramKeahlian::class, 'program_keahlian_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }
}
