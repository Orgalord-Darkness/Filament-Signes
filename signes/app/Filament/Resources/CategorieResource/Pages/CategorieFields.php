<?php

namespace App\Filament\Resources\CategorieResource\Pages;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\CheckBox;
use Filament\Forms\Components\Select;
use App\Repositories\CommuneRepository;
use Filament\Forms\Components\Fieldset;
use Filament\Forms;

class CategorieFields
{
    public static function getFields()
    {
        return Fieldset::make('CATEGORIES')
            ->schema([
                Grid::make()
                ->schema([
                Forms\Components\TextInput::make('code')->required(),
                Forms\Components\TextInput::make('libelle')->required(),
                ])
            ]);
    }
}