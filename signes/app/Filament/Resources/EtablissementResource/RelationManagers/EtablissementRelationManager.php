<?php

namespace App\Filament\Resources\EtablissementResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EtablissementRelationManager extends RelationManager
{
    protected static string $relationship = 'categorie_id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('secteur_id')
                ->relationship('secteur', 'libelle')
                ->required(),
                
                Select::make('categorie_id')
                ->relationship('categorie', 'libelle')
                ->required(),
                
                Select::make('commune_id')->label('Commune')
                ->required()  
                ->live()
                // ->options(function (CommuneRepository $repository): array{
                //     return $repository->getCommunes()->pluck('libelle','insee')->toArray();
                // }),
                ->relationship('commune','libelle'),

                Select::make('gestionnaire_id')
                ->relationship('gestionnaire', 'nom'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Etablissement')
            ->columns([
                Tables\Columns\TextColumn::make('Etablissement'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
