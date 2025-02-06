<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SignalementResource\Pages;
use App\Filament\Resources\SignalementResource\RelationManagers;
use App\Models\Signalement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SignalementResource\Pages\FiltersSignalement ;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

class SignalementResource extends Resource
{
    protected static ?string $model = Signalement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        // return $form
        //     ->schema([
        //         //
        //         Forms\Components\DatePicker::make('date_evenement')
        //         ->label('Date et heure du signalement')
        //         ->required(),

        //         Forms\Components\DatePicker::make('date')
        //         ->label('Date et heure de l\'évenement')
        //         ->required(),

        //         Forms\Components\Radio::make('public')
        //         ->options([
        //             'Enfant'=> 'Enfant',
        //             'PA' => 'PA',
        //             'PH'=> 'PH',
        //         ])
        //         ->inline() // Pour afficher les options en ligne
        //         ->required(), 

        //         Forms\Components\Select::make('secteur_id')
        //         ->relationship('secteur', 'libelle')
        //         ->required(),

        //         Forms\Components\Select::make('etablissement_id')
        //         ->relationship('etablissement', 'nom')
        //         ->required(),

        //         Forms\Components\Radio::make('civilité')
        //             ->options([
        //                 'M.' => 'M.',
        //                 'Mme' => 'Mme',
        //             ])
        //             ->inline() // Pour afficher les options en ligne
        //             ->required(),
        //         Forms\Components\TextInput::make('prenom')->required(), 
        //         Forms\Components\TextInput::make('nom')->required(),
        //         Forms\Components\TextInput::make('email')->label('Courriel')->email()->required(),

        //         Forms\Components\TextInput::make('tel')
        //         ->numeric()
        //         ->integer()
        //         ->required(),
                
        //         Forms\Components\CheckBoxList::make('ars_info')
        //         ->options(['ARS'=>'Agence Régionale de Santé']),

        //         Forms\Components\CheckBoxList::make('ddpp_info')
        //         ->options(['DDPP'=>'Direction Départementale de la Portection des Populations']),

        //         Forms\Components\CheckBoxList::make('dtpjj_info')
        //         ->options(['DTPJJ'=>'Direction Territoire de la Protection Judiciaire de la Jeunesse du Val d\'Oise']),

        //         Forms\Components\CheckBoxList::make('dtpjj_info')
        //         ->options(['P'=>'Préfet']),
                

        //     ]);

        return $form
        ->schema([
            Wizard::make([
                Step::make('Etablissement-Déclarant')
                ->schema([
                    Forms\Components\DatePicker::make('date_evenement')
                    ->label('Date et heure du signalement')
                    ->required(),

                    Forms\Components\DatePicker::make('date')
                    ->label('Date et heure de l\'évenement')
                    ->required(),

                    Forms\Components\Radio::make('public')
                    ->options([
                        'Enfant'=> 'Enfant',
                        'PA' => 'PA',
                        'PH'=> 'PH',
                    ])
                    ->inline() // Pour afficher les options en ligne
                    ->required(), 

                    Forms\Components\Select::make('secteur_id')
                    ->relationship('secteur', 'libelle')
                    ->required(),

                    Forms\Components\Select::make('etablissement_id')
                    ->relationship('etablissement', 'nom')
                    ->required(),

                    Forms\Components\Radio::make('civilité')
                        ->options([
                            'M.' => 'M.',
                            'Mme' => 'Mme',
                        ])
                        ->inline() // Pour afficher les options en ligne
                        ->required(),
                    Forms\Components\TextInput::make('prenom')->required(), 
                    Forms\Components\TextInput::make('nom')->required(),
                    Forms\Components\TextInput::make('email')->label('Courriel')->email()->required(),

                    Forms\Components\TextInput::make('tel')
                    ->numeric()
                    ->integer()
                    ->required(),
                    
                    Forms\Components\CheckBoxList::make('ars_info')
                    ->options(['ARS'=>'Agence Régionale de Santé']),

                    Forms\Components\CheckBoxList::make('ddpp_info')
                    ->options(['DDPP'=>'Direction Départementale de la Portection des Populations']),

                    Forms\Components\CheckBoxList::make('dtpjj_info')
                    ->options(['DTPJJ'=>'Direction Territoire de la Protection Judiciaire de la Jeunesse du Val d\'Oise']),

                    Forms\Components\CheckBoxList::make('dtpjj_info')
                    ->options(['P'=>'Préfet']),
                ]),  
                Step::make('Faits-Victimes')
                ->schema([
                    Forms\Components\Select::make('categorie_id')
                    ->relationship('categorie','libelle'),

                    // Forms\Components\Select::make('rub_nature1_id')
                    // ->relationship('rubrique','libelle'),

                    Forms\Components\TextArea::make('nature1_autre'),

                    // Forms\Components\Select::make('rub_nature2_id')
                    // ->relationship('rubrique','libelle'),

                    Forms\Components\TextArea::make('nature2_autre'),

                    Forms\Components\TextArea::make('description'),




                ]),  
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id')
                ->searchable()
                ->sortable()
                ->wrap(),

                Tables\Columns\TextColumn::make('date_evenement')
                ->searchable()
                ->sortable()
                ->wrap(),

                Tables\Columns\TextColumn::make('secteur.libelle')
                ->searchable()
                ->sortable()
                ->wrap(),

                Tables\Columns\TextColumn::make('etablissement.libelle')
                ->searchable()
                ->sortable()
                ->wrap(),

                Tables\Columns\TextColumn::make('statut')
                ->searchable()
                ->sortable()
                ->wrap(),

                Tables\Columns\TextColumn::make('complet')
                ->searchable()
                ->sortable()
                ->wrap(),

            ])
            //->filters(FiltersSignalement::getFilters(), layout: FiltersLayout::AboveContent)
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
            'index' => Pages\ListSignalements::route('/'),
            'create' => Pages\CreateSignalement::route('/create'),
            'edit' => Pages\EditSignalement::route('/{record}/edit'),
        ];
    }
}
