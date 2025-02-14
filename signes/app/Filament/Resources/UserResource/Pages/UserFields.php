<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use App\Repositories\CommuneRepository;
use Filament\Forms\Components\Fieldset;
use Carbon\Carbon;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SignalementResource\Pages;
use App\Filament\Resources\SignalementResource\RelationManagers;
use App\Models\Signalement;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Checkboxlist;
use Illuminate\Support\Facades\Hash;

class UserFields
{
    public static function getFields()
    {
        return Fieldset::make('UTILISATEURS')->schema([
            Radio::make('Civilité')
                ->options([
                    'M.' => 'M.',
                    'Mme' => 'Mme',
                ])
                ->inline() // Pour afficher les options en ligne
                ->required(),
            Forms\Components\TextInput::make('prenom')->required(), 
            Forms\Components\TextInput::make('nom')->required(),
            Forms\Components\TextInput::make('email')->label('Courriel')->email()->required(),
            Forms\Components\TextInput::make('name')->label('Identifiant')->required(),
            Forms\Components\TextInput::make('password')
            ->label('Mot de passe')
            ->password()
            ->dehydrateStateUsing(fn($state) => Hash::make($state))
            ->required(),
            Forms\Components\TextInput::make('password_confirmation')
                ->password()
                ->required()
                ->maxLength(255)
                ->same('password')
                ->dehydrateStateUsing(fn($state) => Hash::make($state))
                ->label('Conformation du mot de passe'),
            CheckBoxList::make('roles')
               ->relationship('roles','name'),
            Select::make('secteur')
            ->relationship('secteur', 'libelle')
            ->required(),  
            Select::make('etablissements')
            ->relationship('etablissements', 'nom')
            ->required(),
            CheckBox::make('actif')
                    ->label('Actif')
                    ->required(), 
        ]);
    }
}