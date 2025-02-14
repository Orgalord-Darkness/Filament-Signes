<?php

namespace App\Filament\Resources\EtablissementResource\Pages;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\CheckBox;
use Filament\Forms\Components\Select;
use App\Repositories\CommuneRepository;
use Filament\Forms\Components\Fieldset;
use Filament\Forms;

class EtablissementFields
{
    public static function getFields()
    {
        return Fieldset::make('ETABLISSEMENT')->schema([
            //
            Forms\Components\TextInput::make('delos')->label('Identifiant DELOS')->required(), 
            Forms\Components\TextInput::make('nom')->required(),

            Select::make('secteur_id')
                ->relationship('secteur', 'libelle')
                ->required(),
                
            Select::make('categorie_id')
                ->relationship('categorie', 'libelle')
                ->required(),   

            Select::make('statut')
                ->options([
                    'ASSO' => 'Association',
                    'HOSP'=> 'Hôpital',
                    'PRIVE'=> 'Privé',
                ])
                ->required(),    

            Select::make('type')
                ->options([
                    'ET' => 'Etablissement',
                    'SE' => 'Service',
                    'STF' => 'Structure non tarifée',
            ]),

            Select::make('competence')
                ->options([
                    'CD' => 'Département VO',
                    'CDARS' => 'Département - Agence Régionale de Santé',
                    'CDDPJJ' => 'Département - DPJJ',
                    '' => 'Hors département VO',
                ])
                ->required(),
            Forms\Components\TextInput::make('adresse')->required(),
            Forms\Components\TextInput::make('adresse2')->label('Complément adresse'),

            Select::make('commune_id')->label('Commune')
            ->required()  
            ->live()
            // ->options(function (CommuneRepository $repository): array{
            //     return $repository->getCommunes()->pluck('libelle','insee')->toArray();
            // }),
            ->relationship('commune','libelle'),
            
            Forms\Components\TextInput::make('territoire')->disabled(),
            Forms\Components\TextInput::make('tel')->label('Téléphone'),
            Forms\Components\TextInput::make('email')->email(),

            Select::make('gestionnaire_id')
            ->relationship('gestionnaire', 'nom'),  

            CheckBox::make('actif')
                    ->label('Actif')
                    ->required(), 
        ]);
    }
}