<?php

namespace App\Http\Middleware;

use App\Models\ProgramKeahlian;
use Closure;
use Illuminate\Http\Request;

/**
 * Halaman publik (Beranda, Profil) membutuhkan satu baris program_keahlian.
 * Middleware ini memberi pesan yang jelas bila admin belum mengisi Profil sama sekali,
 * alih-alih error 500 yang membingungkan pengunjung.
 */
class EnsureProgramExists
{
    public function handle(Request $request, Closure $next)
    {
        if (! ProgramKeahlian::exists()) {
            abort(503, 'Situs belum dikonfigurasi. Admin perlu mengisi menu Profil terlebih dahulu.');
        }

        return $next($request);
    }
}
