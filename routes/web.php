<?php

use App\Http\Controllers\Site\{AssetController, GaleriController, HomeController, LaboratoriumController, ProfilController};
use Illuminate\Support\Facades\Route;

Route::middleware('ensure-program')->group(function () {
    Route::get('/', HomeController::class)->name('beranda');
    Route::get('profil', ProfilController::class)->name('profil');
});

Route::get('laboratorium', [LaboratoriumController::class, 'index'])->name('laboratorium.index');
Route::get('laboratorium/{laboratorium}', [LaboratoriumController::class, 'show'])->name('laboratorium.show');
Route::get('asset', AssetController::class)->name('asset');
Route::get('galeri', GaleriController::class)->name('galeri');

require __DIR__.'/admin.php';
