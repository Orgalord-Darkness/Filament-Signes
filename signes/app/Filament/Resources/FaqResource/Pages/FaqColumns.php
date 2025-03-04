<?php 

namespace App\Filament\Resources\FaqResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 

class FaqColumns 
{
    public static function getColumns(): array {
        return [
            //
            TextColumn::make('id')->label('Id')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('created_at')->label('Créé le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')->label('Modifié le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('deleted_at')->label('Supprimé le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('catfaq.libelle')
                ->label('Catégorie')
                ->wrap()
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('question')
                ->wrap()
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('reponse')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),

        ] ; 
    }
}