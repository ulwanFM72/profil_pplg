<?php

use App\Http\Controllers\Admin\{AngkatanController, AssetController, DashboardController, GaleriController,
    LaboratoriumController, LoginController, ProfilController, SejarahController, StatistikController, TimelineController};
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'create'])->name('login');
        Route::post('login', [LoginController::class, 'store'])->name('login.store');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
        Route::get('dashboard', DashboardController::class)->name('dashboard');

        Route::get('profil', [ProfilController::class, 'edit'])->name('profil.edit');
        Route::put('profil', [ProfilController::class, 'update'])->name('profil.update');
        Route::get('sejarah', [SejarahController::class, 'edit'])->name('sejarah.edit');
        Route::put('sejarah', [SejarahController::class, 'update'])->name('sejarah.update');

        foreach ([
            'timeline' => TimelineController::class,
            'laboratorium' => LaboratoriumController::class,
            'asset' => AssetController::class,
            'galeri' => GaleriController::class,
            'angkatan' => AngkatanController::class,
            'statistik' => StatistikController::class,
        ] as $uri => $controller) {
            Route::resource($uri, $controller)->except('show');
        }
    });
});
