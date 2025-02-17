<?php 

namespace App\Filament\Resources\EtablissementResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 

class EtablissementColumns 
{
    public static function getColumns(): array {
        return [
            Tables\Columns\TextColumn::make('nom'),
            Tables\Columns\TextColumn::make('secteur.libelle'),
            Tables\Columns\TextColumn::make('categorie.code'),
            Tables\Columns\TextColumn::make('statut'),
            Tables\Columns\TextColumn::make('type'),
            Tables\Columns\TextColumn::make('competence'),
            Tables\Columns\TextColumn::make('commune_id'),
        ] ; 
    }
}