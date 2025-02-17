<?php 

namespace App\Filament\Resources\CatFaqResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 

class CatFaqColumns 
{
    public static function getColumns(): array {
        return [
            Tables\Columns\TextColumn::make('libelle')
            ->wrap()
            ->searchable()
            ->sortable(),
            
            Tables\Columns\TextColumn::make('actif')
            ->formatStateUsing(function ($state) {
                return $state ? 'Oui' : 'Non';
            })
            ->wrap()
            ->searchable()
            ->sortable(),
        ] ; 
    }
}