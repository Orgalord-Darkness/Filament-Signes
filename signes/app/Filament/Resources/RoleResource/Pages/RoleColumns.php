<?php 

namespace App\Filament\Resources\RoleResource\Pages ; 

use Filament\Tables ; 

class RoleColumns 
{
    public static function getColumns(): array {
        return [
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

        ] ; 
    }
}