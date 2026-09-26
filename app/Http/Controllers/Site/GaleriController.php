<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class GaleriController extends Controller
{
    public function __invoke()
    {
        // Pencarian & filter kini ditangani langsung oleh komponen Livewire <livewire:galeri-search />.
        return view('site.galeri');
    }
}
