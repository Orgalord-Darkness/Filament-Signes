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
use App\Filament\Resources\OptionResource\Pages\OptionFields ; 
use App\Filament\Resources\OptionResource\Pages\OptionColumns ; 

class OptionResource extends Resource
{
    protected static ?string $model = Option::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Administration';

    // Définir le label de navigation
    protected static ?string $navigationLabel = 'Paramétrage';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                OptionFields::getFields()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(OptionColumns::getColumns())
            // ->filters(
            //     //
            //     FiltersOption::getFilters(), layout: FiltersLayout::AboveContent
            // )
            ->actions([
                Tables\Actions\EditAction::make()
                ->label('modifier'),
                Tables\Actions\DeleteAction::make()
                ->label('supprimer'),
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

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count(); 
    }
}
