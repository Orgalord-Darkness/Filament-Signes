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
use App\Models\Section ; 
use Illuminate\Support\Facades\Auth;

class ActionSignalementFields
{
    public static function getFields()
    {
        return Fieldset::make('ACTION SIGNALEMENT')
        ->schema([
            Select::make('signalement_id')
            ->relationship('signalement', 'id')
            ->required(),

            Select::make('question_id')
            ->relationship('question', 'libelle', function ($query) { 
                $id = 1 ; 
                $sections = Section::all(); 
                foreach($sections as $ligne){
                    if($ligne['libelle'] == 'Action'){
                        $id = $ligne['id'];
                        break ; 
                    }
                }
                $query->where('section_id',$id); 
            })  
            ->required(),

            Select::make('motif_id')
            ->relationship('motif', 'libelle', function ($query) { 
                $id = 1 ; 
                $sections = Section::all(); 
                foreach($sections as $ligne){
                    if($ligne['libelle'] == 'Action'){
                        $id = $ligne['id'];
                        break ; 
                    }
                }
                $query->where('section_id',$id); 
            })
            ->required(),  

            TextInput::make('question'), 

            TextArea::make('question_libre'), 
            TextArea::make('reponse'), 

            Select::make('user_id')
            ->relationship('user', 'nom')
            ->default(Auth::user()->id)
            ->required(),
        ]) 
        ; 
    }
}