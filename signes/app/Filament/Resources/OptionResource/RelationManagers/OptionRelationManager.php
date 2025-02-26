<?php

namespace App\Filament\Resources\OptionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select ; 

class OptionRelationManager extends RelationManager
{
    protected static string $relationship = 'section_id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('section_id')
                ->relationship('section', 'libelle')
                ->required(), 

                Select::make('rubrique_id')
                ->relationship('rubrique', 'libelle')
                ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Option')
            ->columns([
                Tables\Columns\TextColumn::make('Option'),
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
