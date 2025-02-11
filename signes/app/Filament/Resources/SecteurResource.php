<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SecteurResource\Pages;
use App\Filament\Resources\SecteurResource\RelationManagers;
use App\Models\Secteur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SecteurResource\Pages\FiltersSecteur; 
use Filament\Tables\Enums\FiltersLayout;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction; 

class SecteurResource extends Resource
{
    protected static ?string $model = Secteur::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Administration';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            //
            Forms\Components\TextInput::make('libelle')
            ->required(),
            Forms\Components\TextInput::make('code')
            ->required(),
            Forms\Components\TextInput::make('email')
            ->label('1er Courriel :')
            ->required(),
            Forms\Components\TextInput::make('email2')
            ->label('2eme Courriel :'),
            Forms\Components\TextInput::make('delai_relance')
            ->integer()
            ->numeric()
            ->required(),
            Forms\Components\Select::make('responsable_id')
            ->relationship('responsable', 'nom')
            ->required(), 
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            //
            Tables\Columns\TextColumn::make('libelle')
            ->searchable()
            ->wrap()
            ->sortable(),

            Tables\Columns\TextColumn::make('email')
            ->searchable()
            ->wrap()
            ->sortable(),
            
            Tables\Columns\TextColumn::make('email2')
            ->searchable()
            ->wrap()
            ->sortable(),

            Tables\Columns\TextColumn::make('delai_relance')
            ->searchable()
            ->wrap()
            ->sortable(),

            Tables\Columns\TextColumn::make('responsable.nom')
            ->searchable()
            ->wrap()
            ->sortable(),
        ])
            ->filters( FiltersSecteur::getFilters(), layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    FilamentExportBulkAction::make('export')
                    ->label("Télécharger")
                    ->FileName('secteurs')
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
            'index' => Pages\ListSecteurs::route('/'),
            'create' => Pages\CreateSecteur::route('/create'),
            'edit' => Pages\EditSecteur::route('/{record}/edit'),
        ];
    }
}
