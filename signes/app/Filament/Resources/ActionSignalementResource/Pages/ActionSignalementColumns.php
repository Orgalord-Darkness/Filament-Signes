<?php 

namespace App\Filament\Resources\ActionSignalementResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 

class ActionSignalementColumns 
{
    public static function getColumns(): array {
        return [
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
        ] ; 
    }
}