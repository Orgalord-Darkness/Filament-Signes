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
            Tables\Columns\TextColumn::make('catfaq.libelle')
                ->label('Catégorie')
                ->wrap()
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('question')
                ->wrap()
                ->searchable()
                ->sortable(),

        ] ; 
    }
}