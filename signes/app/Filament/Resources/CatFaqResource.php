<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatFaqResource\Pages;
use App\Filament\Resources\CatFaqResource\RelationManagers;
use App\Models\CatFaq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\CheckBox;
use App\Filament\Resources\CatFaqResource\Pages\FiltersCatFaq; 
use Filament\Tables\Enums\FiltersLayout;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction; 
use Illuminate\Support\Facades\DB;
use App\Filament\Resources\CatFaqResource\Pages\CatFaqFields ; 
use App\Filament\Resources\CatFaqResource\Pages\CatFaqColumns ; 

class CatFaqResource extends Resource
{
    protected static ?string $model = CatFaq::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Définir le label de navigation
    protected static ?string $navigationLabel = 'Catégories Aide en ligne';

    protected static ?string $navigationGroup = 'Administration';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
               CatFaqFields::getFields()->columns(1), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(CatFaqColumns::getColumns())
            ->filters(
                //
                FiltersCatFaq::getFilters(), layout: FiltersLayout::AboveContent
            )
            ->actions([
                Tables\Actions\EditAction::make()
                ->visible(fn (CatFaq $record): bool => !$record->actif),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    FilamentExportBulkAction::make('export')
                    ->label("Télécharger")
                    ->FileName('categories_faq')
                    ->defaultFormat('xlsx')
                    ->defaultPageOrientation('landscape')
                ]),
            ])->paginated([5,10,25,50,100,200,300])
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
            'index' => Pages\ListCatFaqs::route('/'),
            'create' => Pages\CreateCatFaq::route('/create'),
            'edit' => Pages\EditCatFaq::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count(); 
    }
}
