<?php 

namespace App\Filament\Resources\ActionSignalementResource\Pages; 

use Filament\Forms ; 
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\CheckBox;
use Filament\Forms\Components\Select;
use App\Repositories\CommuneRepository;
use Filament\Forms\Components\Fieldset;
use App\Models\Signalement ; 

class ActionSignalementFields
{
    public static function getFields()
    {
        return Fieldset::make('ACTION SIGNALEMENT')
        ->schema([
            Select::make('signalement_id')
            ->relationship('signalement', 'id')
            ->required(),

            TextInput::make('motif')
            ->label('Motif')
            ->required(), 

            TextInput::make('question'), 

            TextArea::make('question_libre'), 
            TextArea::make('reponse'), 
        ]) 
        ; 
    }
}