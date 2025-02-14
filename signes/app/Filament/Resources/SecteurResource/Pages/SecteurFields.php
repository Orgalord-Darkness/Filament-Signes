<?php 

namespace App\Filament\Resources\SecteurResource\Pages ; 

use Filament\Forms\Components\Fieldset;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\CheckBox;
use Filament\Forms\Components\Select;

class SecteurFields
{
    public static function getFields()
    {
        return Fieldset::make('SECTEUR')
        ->schema([
            //
            Forms\Components\TextInput::make('libelle')
            ->required(),
            Forms\Components\TextInput::make('code')
            ->required(),
            Forms\Components\TextInput::make('email')
            ->label('1er Courriel :')
            ->required(),
            Forms\Components\TextInput::make('email2')
            ->label('2eme Courriel :'),
            Forms\Components\TextInput::make('delai_relance')
            ->integer()
            ->numeric()
            ->required(),
            Forms\Components\Select::make('responsable_id')
            ->relationship('responsable', 'nom')
            ->required(), 
        ]);
    }
}