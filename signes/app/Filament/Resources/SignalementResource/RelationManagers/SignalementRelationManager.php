<?php

namespace App\Filament\Resources\SignalementResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use App\Repositories\CommuneRepository;
use Filament\Forms\Components\Fieldset;
use Carbon\Carbon;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\SignalementResource\Pages;
use App\Filament\Resources\SignalementResource\RelationManagers;
use App\Models\Option;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Support\Facades\Auth;
use App\Models\Section ;
use Filament\Forms\Components\Grid ; 
use App\Models\Etablissement ; 
use App\Models\Rubrique ; 
use EncryptionFilesAction ; 

class SignalementRelationManager extends RelationManager
{
    protected static string $relationship = 'action';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user','nom')
                    ->default(Auth::user()->id)
                    ->required(),

                Forms\Components\TextInput::make('etat')
                    ->default('Ouvert')
                    ->required(),

                    Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Select::make('secteur_id')
                        ->relationship('secteur', 'libelle')
                        ->required(),

                        Forms\Components\Select::make('etablissement_id')
                        ->relationship('etablissement', 'nom')
                        ->required()
                        ->reactive() 
                        ->afterStateUpdated(function (callable $set, callable $get) {
                            $etablissementId = $get('etablissement_id');
                            if ($etablissementId) {
                                $communeId = Etablissement::find($etablissementId)->commune_id;
                                $set('commune_id', $communeId);

                                $categorieId = Etablissement::find($etablissementId)->categorie_id; 
                                $set('categorie_id',$categorieId); 

                                $type = Etablissement::find($etablissementId)->type; 
                                $set('type', $type) ; 

                                $competence = Etablissement::find($etablissementId)->competence; 
                                $set('competence',$competence); 

                                $territoire = Etablissement::find($etablissementId)->territoire;
                                $set('territoire',$territoire);
                                
                                $statut = Etablissement::find($etablissementId)->statut;
                                $set('statut',$statut);
                            }
                        })
                    ]),

                    Forms\Components\Select::make('commune_id')
                    ->relationship('commune','libelle'),

                    Hidden::make('type'), 
                    Hidden::make('competence'),
                    Hidden::make('territoire'),
                    Hidden::make('statut'),
                    Hidden::make('categorie_id'),
                    Hidden::make('complet')->default(true), 

                    Forms\Components\Select::make('rub_nature1_id')
                    ->label('Catégorie Nature des Faits principale')
                    ->relationship('rub_nature1', 'libelle',function ($query) { 
                        $id = 1 ; 
                        $sections = Section::all(); 
                        foreach($sections as $ligne){
                            if($ligne['libelle'] == 'Nature des Faits'){
                                $id = $ligne['id'];
                                break ; 
                            }
                        }
                        $query->where('section_id',$id);
                        $query->orderBy('ordre','asc'); 
                    })
                    ->afterStateUpdated(function ($state, callable $set, callable $get) 
                    {
                         $rubriqueId = $get('rubrique_id');
                        if ($rubriqueId) {
                            $sectionId = Rubrique::find($rubriqueId)->section_id;
                            $set('nature1_id', $sectionId);
                        }

                        $rubriques = Rubrique::all();
                        $id_autre = null ; 
                        foreach($rubriques as $ligne){
                            if($ligne['libelle'] == '13-Autre'){
                                $id_autre = $ligne['id'] ; 
                            }
                        }
                        if ($state == $id_autre) {
                            $set('nature1_inter', 'Autre'); 
                        }
                    })
                    ->reactive()
                    ->required(),

                    Forms\Components\Select::make('nature1_id')
                    ->label('Nature des Faits principale')
                    ->required()
                    ->relationship('nature1','libelle', function ($query, callable $get) { 
                        $id = 1 ; 
                        $rub = $get('rub_nature1_id') ; 
                        $sections = Section::all(); 
                        foreach($sections as $ligne){
                            if($ligne['libelle'] == 'Nature des Faits'){
                                $id = $ligne['id'];
                                break ; 
                            }
                        }
                        $query->where('section_id',$id)
                        ->where('rubrique_id',$rub); 
                    }),

                    Forms\Components\Select::make('rub_nature2_id')
                    ->label('Catégorie Natire des Faits secondaire')
                    ->reactive()
                    ->relationship('rub_nature2', 'libelle',function ($query) { 
                        $id = 1 ; 
                        $sections = Section::all(); 
                        foreach($sections as $ligne){
                            if($ligne['libelle'] == 'Nature des Faits'){
                                $id = $ligne['id'];
                                break ; 
                            }
                        }
                        $query->where('section_id',$id);
                        $query->orderBy('ordre','asc'); 
                    })
                    ->afterStateUpdated(function ($state, callable $set, callable $get) 
                    {
                         $rubriqueId = $get('rubrique_id');
                        if ($rubriqueId) {
                            $sectionId = Rubrique::find($rubriqueId)->section_id;
                            $set('nature1_id', $sectionId);
                        }

                        $rubriques = Rubrique::all();
                        $id_autre = null ; 
                        foreach($rubriques as $ligne){
                            if($ligne['libelle'] == '13-Autre'){
                                $id_autre = $ligne['id'] ; 
                            }
                        }
                        if ($state == $id_autre) {
                            $set('nature2_inter', 'Autre'); 
                        }
                    }),
                    Forms\Components\Select::make('secours_id')
                        ->label('Demande d\'intervention des secours' )
                        ->relationship('secours','libelle', function ($query) { 
                            $id = 1 ; 
                            $sections = Section::all(); 
                            foreach($sections as $ligne){
                                if($ligne['libelle'] == 'Secours'){
                                    $id = $ligne['id'];
                                    break ; 
                                }
                            }
                            $query->where('section_id',$id); 
                        })
                        ->afterStateUpdated(function ($state, callable $set, callable $get) {
                            $sections = Option::all(); 
                            $id_non = null ;
                            $id_autre = null ; 
                            foreach($sections as $ligne){
                                if($ligne['libelle'] == 'Non'){
                                    $id_non = $ligne['id'] ; 
                                }
                                if($ligne['libelle'] == 'Autre'){
                                    $id_autre = $ligne['id'] ; 
                                }
                            }
                            if ($state == $id_autre) {
                                $set('inter_secours_autre', 'Autre');
                                // logger()->info('Test'); 
                            }
                            if ($state == $id_non) {
                                $set('inter_secours_non', 'Non');
                            }
                        })
                        ->reactive()
                        ->required(),
                    Forms\Components\Select::make('analyse_group_id')
                    ->label('Groupe d\'analyse')
                    ->relationship('analyse_groupe','libelle', function ($query) { 
                        $id = 1 ; 
                        $sections = Section::all(); 
                        foreach($sections as $ligne){
                            if($ligne['libelle'] == 'Analyse'){
                                $id = $ligne['id'];
                                break ; 
                            }
                        }
                        $query->where('section_id',$id); 
                    })
                    ->reactive(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user_id')
            ->columns([
                
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
