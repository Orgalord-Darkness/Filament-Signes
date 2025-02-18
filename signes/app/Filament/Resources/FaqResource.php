<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource\RelationManagers;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select ; 
use Filament\Forms\Components\TextArea ; 
use Filament\Forms\Components\CheckBox;
use App\Filament\Resources\FaqResource\Pages\FiltersFaq; 
use Filament\Tables\Enums\FiltersLayout;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction; 
use App\Filament\Resources\FaqResource\Pages\FaqFields ; 
use App\Filament\Resources\FaqResource\Pages\FaqColumns ; 


class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Définir le label de navigation
    protected static ?string $navigationLabel = 'Aide en ligne';

    protected static ?string $navigationGroup = 'Administration';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                FaqFields::getFields()->columns(1), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(FaqColumns::getColumns())
            ->filters(  FiltersFaq::getFilters(), layout: FiltersLayout::AboveContent)
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
                    ->FileName('faq')
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count(); 
    }
}
