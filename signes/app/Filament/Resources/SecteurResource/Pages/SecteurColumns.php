<?php 

namespace App\Filament\Resources\SecteurResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 

class SecteurColumns 
{
    public static function getColumns(): array {
        return [
            //
            Tables\Columns\TextColumn::make('libelle')
            ->searchable()
            ->wrap()
            ->sortable(),

            Tables\Columns\TextColumn::make('email')
            ->searchable()
            ->wrap()
            ->sortable(),
            
            Tables\Columns\TextColumn::make('email2')
            ->searchable()
            ->wrap()
            ->sortable(),

            Tables\Columns\TextColumn::make('delai_relance')
            ->searchable()
            ->wrap()
            ->sortable(),

            Tables\Columns\TextColumn::make('responsable.nom')
            ->searchable()
            ->wrap()
            ->sortable(),
        ] ; 
    }
}