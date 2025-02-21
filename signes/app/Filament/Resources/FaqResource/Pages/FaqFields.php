<?php 

namespace App\Filament\Resources\FaqResource\Pages ; 

use Filament\Forms\Components\Fieldset;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkboxlist;
use Illuminate\Support\Facades\Hash;

class FaqFields
{
    public static function getFields()
    {
        return Fieldset::make('AIDE EN LIGNE')
        ->schema([
            //
            Select::make('catfaq_id')
            ->relationship('catfaq', 'libelle')
            ->required(),  //c'est le classe du model pas le nom de la table
            Forms\Components\TextInput::make('question')->required(), 
            Forms\Components\TextArea::make('reponse'),

        ]);
    }
}