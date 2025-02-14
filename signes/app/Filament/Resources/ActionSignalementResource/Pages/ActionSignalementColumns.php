<?php 

namespace App\Filament\Resources\ActionSignalementResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 

class ActionSignalementColumns 
{
    public static function getColumns(): array {
        return [
            TextColumn::make('motif')
            ->wrap(), 
            TextColumn::make('question')
            ->label('question libre')
            ->searchable()
            ->wrap(), 
            TextColumn::make('created_at')
            ->label('Créé le')
            ->wrap(), 
        ] ; 
    }
}