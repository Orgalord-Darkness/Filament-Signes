<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategorieResource\Pages;
use App\Filament\Resources\CategorieResource\RelationManagers;
use App\Models\Categorie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\CheckBox;
use App\Filament\Resources\CategorieResource\Pages\FiltersCategorie; 
use Filament\Tables\Enums\FiltersLayout;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction; 
use Filament\Tables\Actions\CreateAction ;
use Filament\Tables\Actions\EditAction ;
use Filament\Tables\Actions\DeleteAction ; 
use Filament\Tables\Actions\RestoreAction;
use Filament\Forms\Components\Grid ; 

class CategorieResource extends Resource
{
    protected static ?string $model = Categorie::class;

    //protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationIcon = 'heroicon-o-flag';
    // Définir le label de navigation
    protected static ?string $navigationLabel = 'Catégories Etablissements';

    protected static ?string $pluralLabel = 'Categories';
    protected static ?string $label = 'Une Catégorie';

    protected static ?string $navigationGroup = 'Administration';
    // protected static ?int $navigationSort = 2 ;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('libelle')
                    ->wrap()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('actif')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return $state ? 'Oui' : 'Non';
                    }),
            ])
            ->filters(
                //
                FiltersCategorie::getFilters(), layout: FiltersLayout::AboveContent
            )
            ->actions([
                EditAction::make()
                    ->visible(fn (Categorie $record): bool => !$record->deleted_at),

                Tables\Actions\Action::make('actif')->label('Désactivé')
                ->icon('heroicon-o-archive-box-x-mark')
                ->modalHeading('Désactivé'.' une Catégorie')
                ->successNotificationTitle('Catégorie '.'Désactivé')
                ->action(function($record) {
                    $record->update([
                        'confirme' => 0, 
                    ]);
                }),
                DeleteAction::make()->label('SUPPRIMER')
                    ->icon('heroicon-o-archive-box-x-mark')
                    ->modalHeading('SUPPRIMER'.' une Catégorie')
                    ->successNotificationTitle('Catégorie '."DESACTIVE"),

                RestoreAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    FilamentExportBulkAction::make('export')
                    ->label("Télécharger")
                    ->FileName('Catégories')
                    ->defaultFormat('xlsx')
                    ->defaultPageOrientation('landscape')
                ]),
            ])->paginated([10,25,50,100,200,300])
            ->defaultSort('id','desc');
            
    }

    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                ->schema([
                Forms\Components\TextInput::make('code')->required(),
                Forms\Components\TextInput::make('libelle')->required(),
                CheckBox::make('actif')
                        ->label('Actif')
                        ->required(), 
                ])
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategorie::route('/create'),
            'edit' => Pages\EditCategorie::route('/{record}/edit'),
        ];
    }
}
