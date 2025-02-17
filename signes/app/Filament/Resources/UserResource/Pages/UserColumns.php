<?php 

namespace App\Filament\Resources\UserResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 

class UserColumns 
{
    public static function getColumns(): array {
        return [
            TextColumn::make('civilite'),
            TextColumn::make('prenom')
            ->searchable(),
            TextColumn::make('nom'),
            TextColumn::make('roles.name'),
            TextColumn::make('secteur.libelle'),
        ] ; 
    }
}