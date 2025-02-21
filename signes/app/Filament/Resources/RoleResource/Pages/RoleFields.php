<?php

namespace App\Filament\Resources\RoleResource\Pages;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use App\Repositories\CommuneRepository;
use Filament\Forms\Components\Fieldset;
use Filament\Forms;

class RoleFields
{
    public static function getFields()
    {
        return Fieldset::make('RÔLE')->schema([
            //
            Forms\Components\TextInput::make('name')
            ->label('Nom')
            ->required(),

            Forms\Components\TextInput::make('guard_name')
            ->label('Nom de garde')
            ->required(), 
        ]);
    }
}