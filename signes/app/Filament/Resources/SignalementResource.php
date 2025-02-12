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
use Illuminate\Support\Facades\Auth;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction; 
use App\Models\Option ;
use App\Models\Section ;
use Filament\Forms\Components\Grid ; 
use App\Models\Commune ; 
use App\Models\Etablissement ; 
use App\Models\Rubrique ; 


class SignalementResource extends Resource
{
    protected static ?string $model = Signalement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Administration';

     protected static ?int $navigationSort = 0 ;

    public static function form(Form $form): Form
    {
        
        return $form
        ->schema([
            Tabs::make('Signalement')
                ->tabs([
                Tab::make('Etablissement-Déclarant')
                ->schema([
                    Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\DatePicker::make('date_evenement')
                        ->label('Date et heure du signalement')
                        ->default(Now())
                        ->required(),

                        Forms\Components\DatePicker::make('date')
                        ->label('Date et heure de l\'évenement')
                        ->default(Now())
                        ->required(),
                    ]),

                    Forms\Components\Radio::make('public')
                    ->options([
                        'Enfant'=> 'Enfant',
                        'PA' => 'PA',
                        'PH'=> 'PH',
                    ])
                    ->inline() // Pour afficher les options en ligne
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
                    Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Radio::make('civilite')
                        ->options([
                            'M.' => 'M.',
                            'Mme' => 'Mme',
                        ])
                        ->inline() // Pour afficher les options en ligne
                        ->default(Auth::user()->civilite)
                        ->required(),
                        Forms\Components\TextInput::make('prenom')
                        ->default(Auth::user()->prenom)
                        ->required(), 
                        Forms\Components\TextInput::make('nom')
                        ->default(Auth::user()->nom)
                        ->required(),
                    ]),
                    Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('email')
                        ->label('Courriel')
                        ->email()
                        ->default(Auth::user()->email)
                        ->required(),

                        Forms\Components\TextInput::make('tel')
                        ->numeric()
                        ->required(),

                        Forms\Components\Select::make('fonction_id')
                        ->label('Fonction')
                        ->relationship('fonction','libelle', function ($query) { 
                            $id = 1 ; 
                            $sections = Section::all(); 
                            foreach($sections as $ligne){
                                if($ligne['libelle'] == 'Fonctions déclarant'){
                                    $id = $ligne['id'];
                                    break ; 
                                }
                            }
                            $query->where('section_id',$id); 
                        })  
                        ->required(),
                    ]),
                                    
                    Forms\Components\Select::make('user_id')
                    ->relationship('user','nom')
                    ->default(Auth::user()->id)
                    ->required(),
                    Forms\Components\Toggle::make('ars_info')
                    ->label('Agence Régionale de Santé')
                    ->default(false),

                    Forms\Components\Toggle::make('ddpp_info')
                    ->default(false)
                    ->label('Direction Départementale de la Portection des Populations'),

                    Forms\Components\Toggle::make('dtpjj_info')
                    ->default(false)
                    ->label('Direction Territoire de la Protection Judiciaire de la Jeunesse du Val d\'Oise'),

                    Forms\Components\Toggle::make('prefet_info')
                    ->default(false)
                    ->label('Préfet'), 

                    Forms\Components\Select::make('commune_id')
                    ->relationship('commune','libelle'),
                    // ->options(function (callable $get) {
                    //     $etablissementId = $get('diplome_id');
                    //     if ($etablissementId) {
                    //         return Commune::where('etablissement_id', $etablissementId)->pluck('libelle', 'id');
                    //     }
                    //     return Commune::all()->pluck('libelle', 'id');
                    // })
                    // ->hidden()
                    // ->reactive(),

                    Forms\Components\TextInput::make('type'),
                    Forms\Components\TextInput::make('competence'),
                    Forms\Components\TextInput::make('territoire'),
                    Forms\Components\TextInput::make('statut'),
                    Forms\Components\Select::make('categorie_id')
                    ->relationship('categorie','libelle'),
                    Forms\Components\Checkbox::make('complet')
                    ->default(true)

                ]),
            Tab::make('Faits-Victime')
                ->schema([
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
                    ->afterStateUpdated(function (callable $set, callable $get) 
                        {
                            $rubriqueId = $get('rubrique_id');
                            if ($rubriqueId) {
                                $sectionId = Rubrique::find($rubriqueId)->section_id;
                                $set('nature1_id', $sectionId);
                            }
                        })
                    ->reactive()
                    ->required(),

                    Forms\Components\Select::make('nature1_id')
                    ->label('Nature des Faits principale')
                    ->required()
                    ->relationship('nature1','libelle', function ($query) { 
                        $id = 1 ; 
                        $sections = Section::all(); 
                        foreach($sections as $ligne){
                            if($ligne['libelle'] == 'Nature des Faits'){
                                $id = $ligne['id'];
                                break ; 
                            }
                        }
                        $query->where('section_id',$id); 
                    }),

                    Forms\Components\TextArea::make('nature1_autre'),

                    Forms\Components\Select::make('rub_nature2_id')//ne passe pas 
                    ->default(1)
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
                    }),
                    Forms\Components\Select::make('nature2_id')//ne passe pas 
                    ->default(1)
                    ->relationship('nature2','libelle'), 
                    Forms\Components\TextArea::make('nature2_autre'),

                    Forms\Components\TextArea::make('description'),

                    Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Radio::make('eig')
                        ->label('L\'EIG s\'est passé pendant une période tenue de l\'organisation ' )
                        ->options([
                            'Oui'=>'Oui',
                            'Non'=>'Non',
                        ])
                        ->required(),
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
                    ]),

                    Forms\Components\Grid::make(2)
                    ->schema([
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

                        Forms\Components\Radio::make('perex_pec')
                        ->label('Nombre de personnes prises en charge exposées')//marche pas 
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

                    Forms\Components\Grid::make(2)
                    ->schema([
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

                        Forms\Components\Radio::make('perex_pro')
                        ->label('Nombre de professionnels exposées')// marche pas
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
                    
                    Forms\Components\Grid::make(2)
                    ->schema([
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

                        Forms\Components\Radio::make('perex_autre')
                        ->label('Nombre de professionnels exposées autre') //marche pas 
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
                ]),
            Tab::make('Conséquences-Mesures')
                ->schema([
                    Forms\Components\Grid::make(2)
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

                    ]),
                    Forms\Components\Grid::make(2)
                    ->schema([
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

                    ]),
                    Forms\Components\Grid::make(2)
                    ->schema([
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
                    ]),
                    
                    Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Select::make('secours_id')
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
                        ->required(),
                        
                        Forms\Components\TextInput::make('secours_non')
                        ->label('Si Non, précisez')
                        ->required(),
                        Forms\Components\TextInput::make('secours_autre')
                        ->label('Si Autre, précisez')
                        ->required(),

                    ]),
                    Forms\Components\Toggle::make('secours_ide')
                    ->label('IDE (Infirmière Diplômée d\'Etat')
                    ->default(false)
                    ->required(),

                    Forms\Components\Toggle::make('secours_medecin')
                    ->label('Médecin')
                    ->default(false)
                    ->required(),

                    Forms\Components\Toggle::make('secours_medecin2')
                    ->label('Médecin traitant')
                    ->default(false)
                    ->required(),

                    Forms\Components\Toggle::make('secours_police')
                    ->label('Police')
                    ->default(false)
                    ->required(),

                    Forms\Components\Toggle::make('secours_samu')
                    ->label('SAMU')
                    ->default(false)
                    ->required(),

                    Forms\Components\Toggle::make('secours_pompiers')
                    ->label('Pompiers')
                    ->default(false)
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
                ]),
        Tab::make('Information-Dispositions')
            ->schema([
                Grid::make()
                ->schema([
                    Forms\Components\Radio::make('information')
                    ->label('Information')
                    ->options([
                        'Oui'=>'Oui',
                        'Non'=>'Non',
                        'Ne sais pas'=>'Ne sais pas',
                        'Sans objet'=>'Sans objet',
                    ])
                    ->reactive()
                    ->required(),
                    
                    Forms\Components\TextInput::make('plus_information'),

                    Forms\Components\TextInput::make('information_non')
                    ->label('Si Non, précisez')
                    ->visible(fn ($get)=>$get('information') === 'Non' ),

                    Forms\Components\TextInput::make('information_autre')
                    ->label('Si Autre, précisez')
                    ->visible(fn ($get)=>$get('information') === 'Autre' ),
                
                ]),
                
                Grid::make()
                ->schema([
                    Forms\Components\Select::make('disposition1')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Adaptation des soins/de la prise en charge' => 'Adaptation des soins/de la prise en charge',
                        'Fin de prise en charge' => 'Fin de prise en charge',
                        'Orientation vers autre établissement/service' => 'Orientation vers autre établissement/service',
                        'Orientation vers Dispositif Personnes Qualifiées' => 'Orientation vers Dispositif Personnes Qualifiées',
                        'Révision du projet de vie' => 'Révision du projet de vie',
                        'Soutien psychologique'=>'Soutien psychologique', 
                        'Transfert/hospitalisation'=>'Transfert/hospitalisation',
                        'Autre'=>'Autre', 
                    ])
                    ->reactive()
                    ->multiple()
                    ->label('Concernant les usagers')
                    ->required(),
                    
                    Forms\Components\TextInput::make('disposition1_autre')
                    ->label('Si Autre, précisez')
                    ->visible(fn ($get)=> in_array('Autre', $get('disposition1') ?? []) ),

                ]),

                Grid::make()
                ->schema([
                    Forms\Components\Select::make('disposition2')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Action de formation' => 'Action de formation',
                        'Action de sensibilité' => 'Action de sensibilité',
                        'Mesure conservatoire' => 'Mesure conservatoire',
                        'Mesure disciplinaire' => 'Mesure disciplinaire',
                        'Soutien psychologique'=>'Soutien psychologique', 
                        'Autre'=>'Autre', 
                    ])
                    ->reactive()
                    ->multiple()
                    ->label('Concernant les professionnels')
                    ->required(),
                    
                    Forms\Components\TextInput::make('disposition2_autre')
                    ->label('Si Autre, précisez')
                    ->visible(fn ($get)=> in_array('Autre', $get('disposition2') ?? [])  ),

                ]),

                Grid::make()
                ->schema([
                    Forms\Components\Select::make('disposition3')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Fonctionnement en mode dégradé' => 'Fonctionnement en mode dégradé',
                        'Mise en place / à jour de procédures' => 'Mise en place / à jour de procédures',
                        'Révision de planning' => 'Révision de planning',
                        'Autre'=>'Autre', 
                    ])
                    ->reactive()
                    ->multiple()
                    ->label('Concernant l\'organisation du travail')
                    ->required(),
                    
                    Forms\Components\TextInput::make('disposition3_autre')
                    ->label('Si Autre, précisez')
                    ->visible(fn ($get)=> in_array('Autre', $get('disposition3') ?? [])  ),
                ]),     

                Grid::make()
                ->schema([
                    Forms\Components\Select::make('disposition4')
                    ->options([
                        'Aucune' => 'Aucune',
                        'Activation d\'une cellule de crise ou d\'un plan' => 'Activation d\'une cellule de crise ou d\'un plan',
                        'Aménagement ou réparation des locaux et / ou équipements' => 'Aménagement ou réparation des locaux et / ou équipements',
                        'Orientation vers autre établissement/service' => 'Demande d\'aide ou d\'appui à autorité administrative ',
                        'Information interne et/ou externe' => 'Information interne et/ou externe',
                        'Autre'=>'Autre', 
                    ])
                    ->reactive()
                    ->label('Concernant l\'établissement')
                    ->multiple()
                    ->required(), 
                  
                    Forms\Components\TextInput::make('disposition4_autre')
                    ->label('Si Autre, précisez')
                    ->visible(fn ($get)=> in_array('Autre', $get('disposition4') ?? [])  ),
                ]),  
            ]),  
        Tab::make('Suites-Répercutions')
            ->schema([
                Grid::make()
                ->schema([
                    Forms\Components\Radio::make('suite1')
                    ->label('Enquête de Police ou de Gendarmerie')
                    ->options([
                        'Oui'=>'Oui',
                        'Non'=>'Non',
                    ])
                    ->required(),
                    
                    Forms\Components\Radio::make('suite2')
                    ->label('Dépôt de plainte')
                    ->options([
                        'Oui'=>'Oui',
                        'Non'=>'Non',
                    ])
                    ->required(),

                    Forms\Components\Radio::make('suite3')
                    ->label('Signalement au Procureur de la République')
                    ->options([
                        'Oui'=>'Oui',
                        'Non'=>'Non',
                    ])
                    ->required(),
                ]),

                Forms\Components\TextArea::make('evolution')
                ->label('évolutions prévisible ou difficultés attendues, les informations saisies dans ce champ sont confidentielles'),

                Grid::make()
                ->schema([
                    Forms\Components\Radio::make('media1')
                    ->label('L\'évènement peut-il avoir un impact médiatique ?')
                    ->options([
                        'Oui'=>'Oui',
                        'Non'=>'Non',
                    ])
                    ->reactive()
                    ->required(),
                    Forms\Components\TextInput::make('media1_oui')
                    ->label('Si oui, dans quelle mesure ?')
                    ->visible(fn ($get) => $get('media1') === 'Oui'),
                ]),

                Grid::make()
                ->schema([
                    Forms\Components\Radio::make('media2')
                    ->label('Les médias sont-ils déjà informés de l\'évènement ?')
                    ->options([
                        'Oui'=>'Oui',
                        'Non'=>'Non',
                    ])
                    ->reactive()
                    ->required(),
                    Forms\Components\TextInput::make('media2_oui')
                    ->label('Si oui, par quel moyen ?')
                    ->visible(fn ($get) => $get('media2') === 'Oui'),
                ]),

                Grid::make()
                ->schema([
                    Forms\Components\Radio::make('media3')
                    ->label('Communication effectuée ou prévue ?')
                    ->options([
                        'Oui'=>'Oui',
                        'Non'=>'Non',
                    ])
                    ->reactive()
                    ->required(),
                    Forms\Components\TextInput::make('media3_oui')
                    ->label('Si oui, précisez par qui ? quand ? comment ?')
                    ->visible(fn ($get) => $get('media3') === 'Oui'),
                ]),
            ]),
            Tab::make('Suivi')
            ->schema([
                Forms\Components\Radio::make('maitrise')
                ->label('Après sa survenue, pensez-vous que l\'évènement soit maîtrisé ?')
                ->options([
                    'Oui' => 'Oui',
                    'Non'=>'Non',
                    'En cours'=>'En cours',
                ]),

                Forms\Components\Radio::make('analyse') //marche pas 
                ->label('L\'évènement va t-il être analysé ?')
                ->options([
                    'O' => 'O',
                    'N'=>'N',
                ]),

                Forms\Components\Radio::make('analyse_car_event') //marche pas
                ->label('Après l\'analyse, comment qualifieriez-vous le caractère de cet évènement ?')
                ->options([
                    'Inévitable' => 'Inévitable',
                    'Probablement inévitable'=>'Probablement inévitable',
                    'Evitable'=>'Evitable',
                    'Probablement évitable'=>'Probablement évitable'
                ]),

                Forms\Components\Radio::make('analyse_collect') //marche pas
                ->label('L\'analyse a-t-elle été réalisée collectivement ?')
                ->options([
                    'Oui' => 'Oui',
                    'Non'=>'Non',
                ])
                ->reactive(),

                Grid::make()
                ->schema([
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

                    Forms\Components\TextInput::make('analyse_group_autre')
                    ->label('Si Autre, précisez')
                    ->visible(fn ($get)=>$get('analyse_group_id') === 'Autre'),
                ]),

                Forms\Components\TextArea::make('commentaire'),
                //Champs automatiques
            ]),
        ])->extraAttributes(['style' => 'width: 1200px; margin: 0 auto;'])
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

                Tables\Columns\TextColumn::make('etablissement.nom')
                ->searchable()
                ->sortable()
                ->wrap(),

                Tables\Columns\TextColumn::make('etat')
                ->searchable()
                ->sortable()
                ->wrap(),

                Tables\Columns\TextColumn::make('complet')
                ->formatStateUsing(function ($state) {
                    return $state ? 'Oui' : 'Non';
                })
                ->searchable()
                ->sortable()
                ->wrap(),

            ])
            //->filters(FiltersSignalement::getFilters(), layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifier'),
                Tables\Actions\DeleteAction::make()->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    FilamentExportBulkAction::make('export')
                    ->label("Télécharger")
                    ->FileName('signalements')
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
            'index' => Pages\ListSignalements::route('/'),
            'create' => Pages\CreateSignalement::route('/create'),
            'edit' => Pages\EditSignalement::route('/{record}/edit'),
        ];
    }
}
