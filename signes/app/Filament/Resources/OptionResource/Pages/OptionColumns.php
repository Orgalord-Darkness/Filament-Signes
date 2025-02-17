<?php 

namespace App\Filament\Resources\OptionResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 

class OptionColumns 
{
    public static function getColumns(): array {
        return [
            Tables\Columns\TextColumn::make('section.libelle')
            ->wrap()
            ->sortable()
            ->searchable(),
            Tables\Columns\TextColumn::make('rubrique.libelle')
            ->wrap()
            ->sortable()
            ->searchable(),
            Tables\Columns\TextColumn::make('libelle')
            ->wrap()
            ->sortable()
            ->searchable(),
            Tables\Columns\TextColumn::make('ordre')
            ->wrap()
            ->sortable()
            ->searchable(),
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