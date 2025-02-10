<?php

namespace App\Filament\Pages\Logs;

use Filament\Panel;

class FilamentLogManager extends \FilipFonal\FilamentLogManager\FilamentLogManager
{
    public function register(Panel $panel): void
    {
        $panel->pages([Logs::class]);
    }
}
