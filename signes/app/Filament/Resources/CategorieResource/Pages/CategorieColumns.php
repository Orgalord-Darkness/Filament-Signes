<?php 

namespace App\Filament\Resources\CategorieResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 
use Filament\Notifications\Notification;

class CategorieColumns 
{
    public static function getColumns(): array {
        return [
            Tables\Columns\TextColumn::make('libelle')
                ->wrap()
                ->searchable()
                ->sortable(),
            Tables\Columns\ToggleColumn::make('actif')
                ->onColor('info')
                ->offColor('danger')
                //->onIcon('heroicon-s-check')
                //->offIcon('heroicon-s-x')
                ->toggleable()
                ->searchable()
                ->sortable()
                // ->afterStateUpdated(function ($record, $state) {
                //     $record->update(['is_active' => $state]);
                // }),
                // ->formatStateUsing(function ($state) {
                //     return $state ? 'Oui' : 'Non';
                // }),
                ->beforeStateUpdated(function ($record, $state) {
                    // Logique avant la mise à jour de l'état
                    return true;
                })
                // ->afterStateUpdated(function ($record, $state) {
                //     // Logique après la mise à jour de l'état
                //     // Par exemple, envoyer une notification
                //     Notification::make()
                //         ->title('Statut mis à jour')
                //         ->success()
                //         ->send()
                // }) 
        ] ; 
    }
}