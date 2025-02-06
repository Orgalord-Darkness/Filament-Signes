<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EtablissementResource\Pages;
use App\Filament\Resources\EtablissementResource\RelationManagers;
use App\Models\Etablissement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select ; 
use Filament\Forms\Components\CheckBox;
use App\Repositories\CommuneRepository; 

class EtablissementResource extends Resource
{
    protected static ?string $model = Etablissement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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

                Select::make('commune')->label('Commune')
                ->required()  
                ->live()
                ->options(function (CommuneRepository $repository): array{
                    return $repository->getCommunes()->pluck('libelle','insee')->toArray();
                }),

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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom'),
                Tables\Columns\TextColumn::make('secteur.libelle'),
                Tables\Columns\TextColumn::make('categorie.code'),
                Tables\Columns\TextColumn::make('statut'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('competence'),
                Tables\Columns\TextColumn::make('commune_id'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEtablissements::route('/'),
            'create' => Pages\CreateEtablissement::route('/create'),
            'edit' => Pages\EditEtablissement::route('/{record}/edit'),
        ];
    }
}
