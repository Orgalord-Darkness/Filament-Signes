<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Signalement ; 
use App\Observers\SignalementObserver ; 
use App\Models\ActionSignalement ; 
use App\Observers\ActionSignalementObserver ; 
use App\Models\User ; 
use App\Observers\UserObserver ; 
use Illuminate\Support\Facades\Validator;

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
        //Ajout de l'observateru de signalement
        Signalement::observe(SignalementObserver::class); 
        User::observe(UserObserver::class); 
        ActionSignalement::observe(ActionSignalementObserver::class);
        Schema::defaultStringLength(191);
        ini_set('memory_limit', '256M');
    }   
}
