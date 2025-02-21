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
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction; 
use App\Filament\Resources\EtablissementResource\Pages\EtablissementFields ;
use App\Filament\Resources\EtablissementResource\Pages\EtablissementColumns ; 
use App\Filament\Resources\EtablissementResource\Pages\EtablissementFilters ; 

class EtablissementResource extends Resource
{
    protected static ?string $model = Etablissement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 1 ;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                 EtablissementFields::getFields(), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(EtablissementColumns::getColumns())
            ->filters(EtablissementFilters::getFilters())
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
                    ->FileName('etablissements')
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
            'index' => Pages\ListEtablissements::route('/'),
            'create' => Pages\CreateEtablissement::route('/create'),
            'edit' => Pages\EditEtablissement::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count(); 
    }
}
