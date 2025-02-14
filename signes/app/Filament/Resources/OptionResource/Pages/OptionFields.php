<?php

namespace App\Filament\Resources\OptionResource\Pages;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use App\Repositories\CommuneRepository;
use Filament\Forms\Components\Fieldset;
use Filament\Forms;

class OptionFields
{
    public static function getFields()
    {
        return Fieldset::make('PARAMETRAGE')->schema([
            //
            Forms\Components\TextInput::make('libelle')
            ->required(),

            Select::make('section_id')
            ->relationship('section', 'libelle')
            ->required(), 

            Select::make('rubrique_id')
            ->relationship('rubrique', 'libelle')
            ->required(), 

            Forms\Components\TextInput::make('ordre')
            ->numeric()
            ->integer()
            ->required(), 

            Forms\Components\CheckBox::make('actif')
                ->label('Actif')
                ->required(), 
        ]);
    }
}