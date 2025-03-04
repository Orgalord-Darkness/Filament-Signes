<?php 

namespace App\Filament\Resources\UserResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 

class UserColumns 
{
    public static function getColumns(): array {
        return [
            TextColumn::make('id')->label('Code')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('created_at')->label('Créer à')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')->label('Modifier le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('name')->label('Name')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('civilite'),
            TextColumn::make('prenom')
            ->searchable(),
            TextColumn::make('nom'),
            TextColumn::make('email')->label('Email')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('roles.name'),
            TextColumn::make('secteur.libelle'),
            TextColumn::make('deleted_at')->label('Désactivé le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
        ] ; 
    }
}