<?php 

namespace App\Filament\Resources\CatFaqResource\Pages ; 

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\CheckBox;
use Filament\Forms\Components\Select;
use App\Repositories\CommuneRepository;
use Filament\Forms\Components\Fieldset;
use Filament\Forms;

class CatFaqFields
{
    public static function getFields()
    {
        return Fieldset::make('CATEGORIE AIDE EN LIGNE')
        ->schema([
            //
            Forms\Components\TextInput::make('libelle')->required(),
            CheckBox::make('actif')
                ->label('Actif')
                ->required(), 
        ]);
    }
}