<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Cegah lupa isi kolom saat pengembangan (mass assignment).
        Model::shouldBeStrict(! app()->isProduction());

        // Paksa HTTPS di production agar aset & form action konsisten di balik proxy/load balancer.
        if (app()->isProduction()) {
            URL::forceScheme('https');
        }
    }
}
