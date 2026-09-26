<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\{Asset, Galeri, Laboratorium, ProgramKeahlian, Statistik};

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('site.home', [
            'program' => ProgramKeahlian::firstOrFail(),
            'stats' => Statistik::tampil()->get(),
            'labs' => Laboratorium::aktif()->latest()->take(3)->get(),
            'assets' => Asset::latest()->take(4)->get(),
            'galeri' => Galeri::latest()->take(6)->get(),
            'keunggulan' => config('site.keunggulan'),
        ]);
    }
}
