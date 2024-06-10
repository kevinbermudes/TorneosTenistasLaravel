<?php

namespace App\Providers;

use App\Models\Tenista;
use App\Models\Torneo;
use App\Policies\TenistaPolicy;
use App\Policies\TorneoPolicy;
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
        Gate::policy(Torneo::class, TorneoPolicy::class);

        // Register policies
        Gate::policy(Tenista::class, TenistaPolicy::class);
    }
}
