<?php

namespace App\Providers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use App\Policies\DosenPolicy;
use App\Policies\MahasiswaPolicy;
use App\Policies\TugasPolicy;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Mahasiswa::class, MahasiswaPolicy::class);
        Gate::policy(Dosen::class, DosenPolicy::class);
        Gate::policy(Tugas::class, TugasPolicy::class);

        FilamentAsset::register([
            Css::make('filament-admin', resource_path('css/filament-admin.css')),
        ]);
    }
}
