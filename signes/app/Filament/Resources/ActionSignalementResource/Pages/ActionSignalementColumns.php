<?php 

namespace App\Filament\Resources\ActionSignalementResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 

class ActionSignalementColumns 
{
    public static function getColumns(): array {
        return [
            TextColumn::make('id')->label('Id')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true), 
            TextColumn::make('question2')->label('Détails')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('reponse')->label('Réponse')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('motif.libelle')
            ->searchable()
            ->sortable()
            ->wrap(), 
            TextColumn::make('question.libelle')
            ->label('question libre')
            ->searchable()
            ->sortable()
            ->wrap(),
            TextColumn::make('user.nom')
            ->label('Créé par')
            ->searchable()
            ->sortable()
            ->wrap(),  
            TextColumn::make('created_at')
            ->label('Créé le')
            ->searchable()
            ->sortable()
            ->wrap(), 
            TextColumn::make('updated_at')->label('Modifier le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('signalement.id')->label('N° Signalement')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
        ] ; 
    }
}