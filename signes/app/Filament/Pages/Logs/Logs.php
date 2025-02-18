<?php

namespace App\Filament\Pages\Logs;

use App\Helpers\UserHelper;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;

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

    public static function getModel(): string 
    {
        return Logs::class ; 
    }

    ///protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function downloadLogs()
    {
        $record = $this->getModel();
        if ($record) {
            $logFile = storage_path('logs/laravel.log');
            return response()->download($logFile);
        }

        return back()->with('error', 'Aucun enregistrement trouvé.');
    }

    protected function getActions(): array
    {
        return [
            Action::make('Download Logs')
            ->label('Télécharger les logs')
                ->action('downloadLogs')
                //->icon('heroicon-o-download'),
        ];
    }
    
    // public static function getNavigationBadge(): ?string
    // {
    //     $taille = static::getModel()::count(); //nombre de logs 
    //     $taille = 99 ; 
    //     $maxSize = 2000000; // Taille maximale autorisée en octets (par exemple, 2 Mo)
    //     return $taille.'+' ; 
    // }
}
