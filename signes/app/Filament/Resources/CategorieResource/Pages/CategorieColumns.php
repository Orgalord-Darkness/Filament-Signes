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
            TextColumn::make('id')->label('Id')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('code')->label('Code')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('libelle')
                ->wrap()
                ->searchable()
                ->sortable(),
            TextColumn::make('deleted_at')->label('Désactivé le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
        ] ; 
    }
}