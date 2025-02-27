<?php 

namespace App\Filament\Resources\CatFaqResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 

class CatFaqColumns 
{
    public static function getColumns(): array {
        return [
            TextColumn::make('id')->label('Id')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('created_at')->label('Créer le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')->label('Modifier le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('libelle')
            ->wrap()
            ->searchable()
            ->sortable(),
            TextColumn::make('deleted_at')->label('Désactivé le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
        ] ; 
    }
}