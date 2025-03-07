<?php
namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider {
    public function boot() {
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'Custom Links',
            ]);

            Filament::registerNavigationItems([
                \Filament\Navigation\NavigationItem::make('Lien personnalisé')
                    ->url('/dashboard')
                    ->icon('heroicon-o-link')
            ]);
        });
    }
}