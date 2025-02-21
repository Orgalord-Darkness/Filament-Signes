<?php 

namespace App\Filament\Resources\RoleResource\Pages ; 

use Filament\Tables ; 

class RoleColumns 
{
    public static function getColumns(): array {
        return [
            Tables\Columns\TextColumn::make('name')
            ->wrap()
            ->sortable()
            ->searchable(),
            Tables\Columns\TextColumn::make('guard_name')
            ->wrap()
            ->sortable()
            ->searchable(),

        ] ; 
    }
}