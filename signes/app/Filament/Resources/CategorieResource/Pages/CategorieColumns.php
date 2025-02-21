<?php 

namespace App\Filament\Resources\CategorieResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 
use Filament\Notifications\Notification;

class CategorieColumns 
{
    public static function getColumns(): array {
        return [
            Tables\Columns\TextColumn::make('libelle')
                ->wrap()
                ->searchable()
                ->sortable(),
        ] ; 
    }
}