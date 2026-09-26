<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function __invoke(Request $request)
    {
        $kategori = in_array($request->kategori, Asset::KATEGORI, true) ? $request->kategori : null;

        return view('site.asset', [
            'assets' => Asset::query()->when($kategori, fn ($q) => $q->where('kategori', $kategori))
                ->orderBy('nama')->paginate(12)->withQueryString(),
            'kategoriList' => Asset::KATEGORI,
            'kategori' => $kategori,
        ]);
    }
}
