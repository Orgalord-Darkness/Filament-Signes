<?php 

namespace App\Filament\Resources\RoleResource\Pages ; 

use Filament\Tables ; 
use Filament\Tables\Columns\TextColumn ; 

class RoleColumns 
{
    public static function getColumns(): array {
        return [
            TextColumn::make('id')->label('Id')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('name')
            ->label('Nom')
            ->wrap()
            ->sortable()
            ->searchable(),
            Tables\Columns\TextColumn::make('guard_name')
            ->label('Nom de garde')
            ->wrap()
            ->sortable()
            ->searchable(),
            TextColumn::make('created_at')->label('Créé le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')->label('Modifiée le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),

        ] ; 
    }
}