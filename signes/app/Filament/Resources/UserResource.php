<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select ; 
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\CheckBox;
use Filament\Forms\Components\CheckBoxList;
use Filament\Forms\Components\Password;
use Illuminate\Support\Facades\Hash;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction; 
use Filament\Tables\Enums\FiltersLayout;
use App\Filament\Resources\UserResource\Pages\FiltersUser;
use App\Filament\Resources\UserResource\Pages\UserFields ;
use App\Filament\Resources\UserResource\Pages\UserColumns ;  


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Définir le label de navigation
    protected static ?string $navigationLabel = 'Utilisateurs';
    
    protected static ?string $pluralLabel = 'Utilisateurs';

    protected static ?string $navigationGroup = 'Administration';
                                                
    public static function form(Form $form): Form
    {
        return $form->schema([
            UserFields::getFields()->columns(1), 
        ]); 
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(UserColumns::getColumns())
            ->filters( FiltersUser::getFilters(), layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make()
                ->label('modifier')
                ->visible(fn (User $record): bool => !$record->deleted_at),
                
                Tables\Actions\DeleteAction::make()
                ->label('désactiver')
                ->icon('heroicon-o-archive-box-x-mark')
                ->modalHeading('désactiver un utilisateur' )
                ->successNotificationTitle('Catégorie '."DESACTIVE"),

                Tables\Actions\RestoreAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    FilamentExportBulkAction::make('export')
                    ->label("Télécharger")
                    ->FileName('utilisateurs')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count(); 
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]) ; 
    }
}
