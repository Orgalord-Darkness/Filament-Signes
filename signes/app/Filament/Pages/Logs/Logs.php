<?php

namespace App\Filament\Pages\Logs;

use App\Helpers\UserHelper;

class Logs extends \FilipFonal\FilamentLogManager\Pages\Logs {

    // public static function shouldRegisterNavigation(): bool
    // {
    //     return UserHelper::isSuperAdmin();
    // }

    public static function getNavigationLabel(): string
    {
        return 'Journal des Logs';
    }

    public function getTitle(): string
    {
        return 'Journal des Logs';
    }
}
