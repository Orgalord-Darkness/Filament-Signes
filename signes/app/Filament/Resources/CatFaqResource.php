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

class CatFaqResource extends Resource
{
    protected static ?string $model = CatFaq::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('libelle')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('libelle'),
                Tables\Columns\TextColumn::make('actif')
                ->formatStateUsing(function ($state) {
                    return $state ? 'Oui' : 'Non';
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCatFaqs::route('/'),
            'create' => Pages\CreateCatFaq::route('/create'),
            'edit' => Pages\EditCatFaq::route('/{record}/edit'),
        ];
    }
}
