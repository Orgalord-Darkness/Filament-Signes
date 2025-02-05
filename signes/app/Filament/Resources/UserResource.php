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


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
                                                
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Radio::make('Civilité')
                    ->options([
                        'M.' => 'M.',
                        'Mme' => 'Mme',
                    ])
                    ->inline(), // Pour afficher les options en ligne
                Forms\Components\TextInput::make('prenom')->required(), 
                Forms\Components\TextInput::make('nom')->required(),
                Forms\Components\TextInput::make('email')->label('Courriel')->email()->required(),
                Forms\Components\TextInput::make('password')->label('Mot de passe')->password()->required(),
                Forms\Components\TextInput::make('password_confirmation')
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->same('password')
                    ->label('Conformation du mot de passe'),
                CheckBoxList::make('Rôles')
                    ->options([
                        'Administrateur' => 'Administrateur',
                        'Gestionnaire' => 'Gestionnaire',
                        'Opérateur' => 'Opérateur',
                        'Utilisateur' => 'Utilisateur',
                    ]),
                Select::make('secteur')
                ->relationship('secteur', 'libelle')
                ->required(),  
                Select::make('etablissements')
                ->relationship('etablissements', 'nom')
                ->required(),
                CheckBox::make('actif')
                        ->label('Actif')
                        ->required(), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('civilite'),
                Tables\Columns\TextColumn::make('prenom'),
                Tables\Columns\TextColumn::make('nom'),
                Tables\Columns\TextColumn::make('role.name'),
                Tables\Columns\TextColumn::make('secteur.libelle'),

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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
