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
            TextColumn::make('id')->label('Id')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('code')->label('Code')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('libelle')
            ->searchable()
            ->wrap()
            ->sortable(),

            Tables\Columns\TextColumn::make('email')
            ->label('1er Courriel')
            ->searchable()
            ->wrap()
            ->sortable(),
            
            Tables\Columns\TextColumn::make('email2')
            ->label('2eme Courriel')
            ->searchable()
            ->wrap()
            ->sortable(),

            Tables\Columns\TextColumn::make('delai_relance')
            ->label('Délai de Relance')
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