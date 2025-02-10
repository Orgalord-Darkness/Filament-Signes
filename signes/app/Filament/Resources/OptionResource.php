<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OptionResource\Pages;
use App\Filament\Resources\OptionResource\RelationManagers;
use App\Models\Option;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select ; 
use App\Filament\Resources\OptionResource\Pages\FiltersOption; 
use Filament\Tables\Enums\FiltersLayout;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction; 

class OptionResource extends Resource
{
    protected static ?string $model = Option::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('libelle')
                ->required(),

                Select::make('section_id')
                ->relationship('section', 'libelle')
                ->required(), 

                Select::make('rubrique_id')
                ->relationship('rubrique', 'libelle')
                ->required(), 

                Forms\Components\TextInput::make('ordre')
                ->numeric()
                ->integer()
                ->required(), 

                Forms\Components\CheckBox::make('actif')
                    ->label('Actif')
                    ->required(), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section.libelle')
                ->wrap()
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('rubrique.libelle')
                ->wrap()
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('libelle')
                ->wrap()
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('ordre')
                ->wrap()
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('actif')
                ->formatStateUsing(function ($state) {
                    return $state ? 'Oui' : 'Non';
                })
                ->wrap()
                ->searchable()
                ->sortable(),

            ])
            // ->filters(
            //     //
            //     FiltersOption::getFilters(), layout: FiltersLayout::AboveContent
            // )
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    FilamentExportBulkAction::make('export')
                    ->label("Télécharger")
                    ->FileName('options')
                    ->defaultFormat('xlsx')
                    ->defaultPageOrientation('landscape')
                ]),
            ])->paginated([10,25,50,100,200,300])
            ->defaultSort('id','desc');
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
            'index' => Pages\ListOptions::route('/'),
            'create' => Pages\CreateOption::route('/create'),
            'edit' => Pages\EditOption::route('/{record}/edit'),
        ];
    }
}
