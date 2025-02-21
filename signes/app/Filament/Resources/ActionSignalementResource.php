<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActionSignalementResource\Pages;
use App\Filament\Resources\ActionSignalementResource\RelationManagers;
use App\Models\ActionSignalement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ActionSignalementResource\Pages\ActionSignalementColumns; 
use App\Filament\Resources\ActionSignalementResource\Pages\ActionSignalementFields; 
//use App\Filament\Resources\ActionSignalementResource\Pages\FiltersActionSignalement ; 
use Filament\Tables\Enums\FiltersLayout;

class ActionSignalementResource extends Resource
{
    protected static ?string $model = ActionSignalement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Gestion';

    protected static ?int $navigationSort = 2 ;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                ActionSignalementFields::getFields(), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                //
            ActionSignalementColumns::getColumns(), 
            )
            ->filters([//FiltersActionSignalement::getFilters(), layout: FiltersLayout::AboveContent
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label('modifier'),
                Tables\Actions\DeleteAction::make()
                ->label('supprimer'),
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
            'index' => Pages\ListActionSignalements::route('/'),
            'create' => Pages\CreateActionSignalement::route('/create'),
            'edit' => Pages\EditActionSignalement::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count(); 
    }
}
