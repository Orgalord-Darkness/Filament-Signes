<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use App\Filament\Pages\Logs\FilamentLogManager;
use Filament\Navigation\MenuItem;
use Filament\View\PanelsRenderHook;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->sidebarWidth('12%')
            ->sidebarCollapsibleOnDesktop()
            ->breadcrumbs(false)
            ->maxContentWidth('100%')
            ->login()
            ->colors([
                'primary' => Color::Red,
                'danger' => Color::Pink, 
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                BreezyCore::make()->myProfile(true, true, false,true,'my-profile'),
                FilamentShieldPlugin::make()
                    ->gridColumns(['default' => 1,'sm' => 2,'lg' => 3])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns(['default' => 1,'sm' => 2,'lg' => 3])
                    ->resourceCheckboxListColumns(['default' => 1,'sm' => 2]),
                FilamentLogManager::make()
            ])
            ->brandName('Signes')
            ->brandLogo(asset('img/logo/logo.png'))
            ->navigationGroups([
                'Gestion', 
                'Administration', 
                'Super Administration', 
                'Système',
            ])
            ->renderHook(PanelsRenderHook::FOOTER, fn () => view('layouts.footer'))
            ->userMenuItems(['logout' => MenuItem::make()->label('Sortir')])
            ;

  }
}
