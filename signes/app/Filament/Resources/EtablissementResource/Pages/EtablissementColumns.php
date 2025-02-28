<?php 

namespace App\Filament\Resources\EtablissementResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 

class EtablissementColumns 
{
    public static function getColumns(): array {
        return [
            Tables\Columns\TextColumn::make('nom')->searchable()->sortable()->wrap(),
            TextColumn::make('created_at')->label('Créer le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')->label('Modifier le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('delos')->label('Delos')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('adresse')->label('adresse')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('adresse2')->label('adresse2')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('tel')->label('Téléphone')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('email')->label('Email')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('territoire')->label('Territoire')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('secteur.libelle'),
            Tables\Columns\TextColumn::make('categorie.code'),
            Tables\Columns\TextColumn::make('statut'),
            Tables\Columns\TextColumn::make('type'),
            Tables\Columns\TextColumn::make('competence'),
            Tables\Columns\TextColumn::make('commune_id'),
            TextColumn::make('gestionnaire.nom')->label('Gestionnaire')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
        ] ; 
    }
}