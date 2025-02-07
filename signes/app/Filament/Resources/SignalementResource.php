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
        return $form
        ->schema([
            // Wizard::make([
            //     Step::make('Etablissement-Déclarant')
            //     ->schema([
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
            //     ]),  
            //     Step::make('Faits-Victimes')
            //     ->schema([
            //         Forms\Components\Select::make('categorie_id')
            //         ->relationship('categorie','libelle'),

            //         // Forms\Components\Select::make('rub_nature1_id')
            //         // ->relationship('rubrique','libelle'),

            //         Forms\Components\TextArea::make('nature1_autre'),

            //         // Forms\Components\Select::make('rub_nature2_id')
            //         // ->relationship('rubrique','libelle'),

            //         Forms\Components\TextArea::make('nature2_autre'),

            //         Forms\Components\TextArea::make('description'),
            //     ]),  
            // ]),
            Tabs::make('Signalement')
            ->tabs([
                Tab::make('Etablissement-Déclarant')
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
            Tab::make('Faits-Victime')
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

                    Forms\Components\Radio::make('eig')
                    ->label('L\'EIG s\'est passé pendant une période tenue de l\'organisation ' )
                    ->options([
                        '1'=>'Oui',
                        '0'=>'Non',
                    ]),
                    Forms\Components\Select::make('periode_eig')
                    ->label('Période EIG')
                    ->options([
                        'Durant la nuit'=>'Durant la nuit',
                        'Durant le week-end'=>'Durant le week-end',
                        'Un jour férié'=>'Un jour férié',
                        'Heure de changement d\'équipe'=>'Heure de changement d\'équipe',
                        'Autre'=>'Autre',
                    ])
                    ->required()
                    ->reactive(),
                    Forms\Components\TextInput::make('periode_eig_autre')
                    ->label('Si Autre, précisez')
                    ->visible(fn ($get) => $get('periode_eig') === 'Autre'),

                    Forms\Components\Radio::make('victimes_pec')
                    ->label('Nombre de victimes prises en charge')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Une' => 'Une',
                        'Deux' => 'Deux',
                        'Trois' => 'Trois',
                        'Quatre'=>'Quatre',
                        'Cinq et plus'=> 'Cinq et plus',
                        'Tous'=>'Tous',
                    ])
                    ->required(),

                    Forms\Components\Radio::make('victimes_pro')
                    ->label('Nombre de victimes professionnels')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Une' => 'Une',
                        'Deux' => 'Deux',
                        'Trois' => 'Trois',
                        'Quatre'=>'Quatre',
                        'Cinq et plus'=> 'Cinq et plus',
                        'Tous'=>'Tous',
                    ])
                    ->required(),

                    Forms\Components\Radio::make('victimes_autre')
                    ->label('Nombre de victimes autre')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Une' => 'Une',
                        'Deux' => 'Deux',
                        'Trois' => 'Trois',
                        'Quatre'=>'Quatre',
                        'Cinq et plus'=> 'Cinq et plus',
                        'Tous'=>'Tous',
                    ])
                    ->required(),

                    Forms\Components\Radio::make('perex_pec')
                    ->label('Nombre de personnes prises en charge exposées')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Une' => 'Une',
                        'Deux' => 'Deux',
                        'Trois' => 'Trois',
                        'Quatre'=>'Quatre',
                        'Cinq et plus'=> 'Cinq et plus',
                        'Tous'=>'Tous',
                    ]),

                    Forms\Components\Radio::make('perex_pro')
                    ->label('Nombre de professionnels exposées')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Une' => 'Une',
                        'Deux' => 'Deux',
                        'Trois' => 'Trois',
                        'Quatre'=>'Quatre',
                        'Cinq et plus'=> 'Cinq et plus',
                        'Tous'=>'Tous',
                    ]),

                    Forms\Components\Radio::make('perex_autre')
                    ->label('Nombre de professionnels exposées autre')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Une' => 'Une',
                        'Deux' => 'Deux',
                        'Trois' => 'Trois',
                        'Quatre'=>'Quatre',
                        'Cinq et plus'=> 'Cinq et plus',
                        'Tous'=>'Tous',
                    ]),
                ]),
            Tab::make('Conséquences-Mesures')
                ->schema([
                    Forms\Components\Select::make('consequence1')
                    ->label('Pour la ou les personnes prises en charge')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Aggravation de la santé' => 'Aggravation de la santé',
                        'Blessure' => 'Blessure',
                        'Changement de comportement ou d\'humeur' => 'Changement de comportement ou d\'humeur',
                        'Décès' => 'Décès',
                        'Hospitalisation'=>'Hospitalisation',
                        'Soin en interne'=>'Soin en interne',
                        'Autre'=>'Autre',                       
                    ])
                    ->reactive()
                    ->required(),
                    Forms\Components\TextInput::make('consequence1_autre')
                    ->label('Si autre précisez')
                    ->visible(fn ($get) => $get('consequence1') === 'Autre'),

                    Forms\Components\Select::make('consequence2')
                    ->label('Pour la ou les professionnels')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Arrêt maladie' => 'Arrêt maladie',
                        'Décès' => 'Décès',
                        'Impossibilité de se rendre sur le lieu de travail' => 'Impossibilité de se rendre sur le lieu de travail',
                        'Organisation d\'une prise en charge médicale et/ou soutien psychologique' => 'Organisation d\'une prise en charge médicale et/ou soutien psychologique',
                        'Autre'=>'Autre',                       
                    ])
                    ->reactive()
                    ->required(),
                    Forms\Components\TextInput::make('consequence2_autre')
                    ->label('Si autre précisez')
                    ->visible(fn ($get) => $get('consequence2') === 'Autre'),

                    Forms\Components\Select::make('consequence3')
                    ->label('Pour l\'organisation et le fonctionnement de l\'établissement')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Difficultés d\'approvisionnement'=> 'Difficultés d\'approvisionnement',
                        'Difficultés d\'accès à l\'établissement ou au lieu de prise en charge'=>'Difficultés d\'accès à l\'établissement ou au lieu de prise en charge', 
                        'Nécessitant d\'évacuation des résidents'=>'Nécessitant d\'évacuation des résidents',
                        'Fonctionnement en mode dégradé' => 'Fonctionnement en mode dégradé', 
                        'Autre'=>'Autre',                       
                    ])
                    ->reactive()
                    ->required(),
                    Forms\Components\TextInput::make('consequence3_autre')
                    ->label('Si autre précisez')
                    ->visible(fn ($get) => $get('consequence3') === 'Autre'),
                    
                    Forms\Components\Select::make('demande_secours')
                    ->label('Demande d\'intervention des secours' )
                    ->options([
                        'Oui' => 'Oui',
                        'Non' =>'Non', 
                        'Refus de l\'usager'=>'Refus de l\'usager',  
                        'Autre'=>'Autre',
                    ])
                    ->required(),
                    Forms\Components\TextInput::make('secours_non')
                    ->label('Si Non, précisez')
                    ->visible(fn ($get) => $get('demande_secours') === 'Non'),
                    Forms\Components\TextInput::make('secours_autre')
                    ->label('Si Autre, précisez')
                    ->visible(fn ($get) => $get('demande_secours') === 'Autre'),

                    Forms\Components\Select::make('secours_id')
                    ->relationship('secours','libelle')
                    ->required(),

                    Forms\Components\TextArea::make('mesure1')
                    ->label('Pour protéger, accompagner ou soutenir les victimes ou personnes exposées - Les informations saisies dans ce champ sont confidentielles'),

                    Forms\Components\TextArea::make('mesure2')
                    ->label('Pour assurer la continuité de la prise en charge- Les informations saisies dans ce champ sont confidentielles'),
                    
                    Forms\Components\TextArea::make('mesure3')
                    ->label('A l\'égard des autres personnes prises en carge ou du personnel, le cas échéant - Les informations saisies dans ce champ sont confidentielles'),
                    
                    Forms\Components\CheckBox::make('mesure3_info')
                    ->label(
                        'Information à l\'ensemble du personnel' 
                    ),

                    Forms\Components\CheckBox::make('mesure3_soutien')
                    ->label(
                        'Soutien psychologique' 
                    ),

                    Forms\Components\CheckBox::make('mesure3_reunion')
                    ->label(
                        'Réunion entre la direction et l\'équipe concernée' 
                    ),
                ])
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
