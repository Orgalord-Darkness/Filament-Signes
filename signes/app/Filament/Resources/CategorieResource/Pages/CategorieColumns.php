<?php 

namespace App\Filament\Resources\CategorieResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 

class CategorieColumns 
{
    public static function getColumns(): array {
        return [
            Tables\Columns\TextColumn::make('libelle')
                ->wrap()
                ->searchable()
                ->sortable(),
            Tables\Columns\ToggleColumn::make('actif')
                ->onColor('success')
                ->offColor('danger')
                //->onIcon('heroicon-s-check')
                //->offIcon('heroicon-s-x')
                ->toggleable()
                ->searchable()
                ->sortable()
                ->afterStateUpdated(function ($record, $state) {
                    $record->update(['is_active' => $state]);
                }),
                // ->formatStateUsing(function ($state) {
                //     return $state ? 'Oui' : 'Non';
                // }),
        ] ; 
    }
}