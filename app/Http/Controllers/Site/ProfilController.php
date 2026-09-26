<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeahlian;

class ProfilController extends Controller
{
    public function __invoke()
    {
        return view('site.profil', [
            'program' => ProgramKeahlian::with(['kepala', 'sejarah.timeline', 'riwayatKepala'])->firstOrFail(),
        ]);
    }
}
