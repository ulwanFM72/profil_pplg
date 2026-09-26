<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Laboratorium;

class LaboratoriumController extends Controller
{
    public function index()
    {
        return view('site.laboratorium.index', ['labs' => Laboratorium::orderBy('nama')->get()]);
    }

    public function show(Laboratorium $laboratorium)
    {
        return view('site.laboratorium.show', ['lab' => $laboratorium->load('assets')]);
    }
}
