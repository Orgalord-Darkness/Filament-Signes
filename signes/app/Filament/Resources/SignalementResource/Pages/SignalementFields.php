<?php

namespace App\Filament\Resources\SignalementResource\Pages;

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
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SignalementResource\Pages;
use App\Filament\Resources\SignalementResource\RelationManagers;
use App\Models\Signalement;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Support\Facades\Auth;
use App\Models\Section ;
use Filament\Forms\Components\Grid ; 
use App\Models\Etablissement ; 
use App\Models\Rubrique ; 
use App\Models\Option ;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Filament\Forms\Components\Section as FilamentSection;
use Filament\Forms\Components\Placeholder;

class SignalementFields
{
    protected function getAutre($champ, $get): bool 
    {
        return in_array('Autre', $get($champ, [])) ; 
    }
    
    public static function getFields()
    {
        $required = [
            'secteur_id', 
            'etablissement_id',
            'public' ,
            'etat', 
            'fonction_id',
            'rub_nature1_id', 
            'nature1_id', 
            'description', 
            'eig',
            'periode_eig', 
            'victimes_pec', 
            'victimes_pro',
            'victimes_autre', 
            'perex_pec',
            'perex_pro',
            'perex_autre', 
        ] ; 
        
        return Fieldset::make('SIGNALEMENT')->schema([
            Tabs::make('Signalement')
                ->tabs([
                Tab::make('Etablissement-Déclarant')
                ->schema([
                    Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\DateTimePicker::make('date')
                        ->label('Date et heure du signalement')
                        ->default((new \DateTime())->format('Y-m-d H:i:s'))
                        ->required(),

                        Forms\Components\DateTimePicker::make('date_evenement')
                        ->label('Date et heure de l\'évenement')
                        ->default((new \DateTime())->format('Y-m-d H:i:s'))
                        ->helperText('Si cette date n\'est pas connue, merci de saisir la date et heure du signalement')
                        ->required(),

                        Forms\Components\Radio::make('public')
                    ->options([
                        'Enfant'=> 'Enfant',
                        'PA' => 'PA',
                        'PH'=> 'PH',
                    ])
                    ->inline() // Pour afficher les options en ligne
                    ->required(),
                    ]),

                    
                    Hidden::make('etat')->default('Ouvert'), 
                    Hidden::make('complet')->default(false), 

                    Forms\Components\Grid::make(2)
                        ->schema([
                            FilamentSection::make('Etablissement/Service')
                            ->schema([
                                Forms\Components\Select::make('secteur_id')
                                ->relationship('secteur', 'libelle')
                                ->afterStateUpdated(function ($state, callable $set, callable $get){
                                    $secteur_id = $get('secteur_id');
                                    if($secteur_id){
                                        $etablissement_id = Etablissement::find($secteur_id)->$secteur_id ; 
                                        $set('etablissement_id', $etablissement_id) ; 
                                    }
                                })
                                ->reactive()
                                ->required(),

                                Forms\Components\Select::make('etablissement_id')
                                ->relationship('etablissement','nom', function ($query, callable $get) { 
                                    $id = null ; 
                                    $secteur = $get('secteur_id') ;  
                                    $etablissements = Etablissement::all(); 
                                    foreach($etablissements as $ligne){
                                        if($ligne['secteur_id'] == $secteur){
                                            $id = $ligne['id'];
                                            break ; 
                                        }
                                    }
                                    $query->where('secteur_id', $secteur) ; 
                                })
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
                        ]), 

                        Forms\Components\Select::make('commune_id')
                        ->relationship('commune','libelle'),

                        Hidden::make('type'), 
                        Hidden::make('competence'),
                        Hidden::make('territoire'),
                        Hidden::make('statut'),
                        Hidden::make('categorie_id'),
                        Hidden::make('complet')->default(false),
                    FilamentSection::make('Déclarant')
                    ->schema([
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

                            Forms\Components\TextInput::make('email')
                            ->label('Courriel')
                            ->email()
                            ->default(Auth::user()->email)
                            ->required(),

                            Forms\Components\TextInput::make('tel')
                            ->label('Téléphone')
                            ->numeric()
                            ->required(),

                            Hidden::make('user_id')
                            ->default(Auth::user()->id)
                            ->required(), 
                        ]),
                                        
                        Hidden::make('user_id')
                        // ->relationship('user','nom')
                        ->default(Auth::user()->id)
                        ->required(),
                    ]), 
                    FilamentSection::make('Autorités administratives informées')
                    ->schema([
                        Forms\Components\Toggle::make('ars_info')
                        ->label('Agence Régionale de Santé')
                        ->default(false),

                        Forms\Components\Toggle::make('ddpp_info')
                        ->default(false)
                        ->label('Direction Départementale de la Protection des Populations'),

                        Forms\Components\Toggle::make('dtpjj_info')
                        ->default(false)
                        ->label('Direction Territoire de la Protection Judiciaire de la Jeunesse du Val d\'Oise'),

                        Forms\Components\Toggle::make('prefet_info')
                        ->default(false)
                        ->label('Préfet'), 
                    ]), 
                ]),
            Tab::make('Faits-Victime')
                ->schema([
                    FilamentSection::make('Nature des faits')->schema([
                        Placeholder::make(' ')
                        ->content('Les exemples cités dans les catégories ci-après ne constituent pas une liste exhaustive, mais ont vocation à aider la structure à identifier les dysfonctionnements et les évènements qui relèvent de l\'article L.331-8-1 du CASF'), 
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
                            }else{
                                $set('nature1_inter','') ; 
                            }
                        })
                        ->reactive()
                        ->default(null)
                        ->requiredIf('complet',true),

                        Forms\Components\Select::make('nature1_id')
                        ->label('Nature des Faits principale')
                        ->requiredIf('complet',true)
                        ->default(null)
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

                        Hidden::make('nature1_inter'), 
                        Forms\Components\TextArea::make('nature1_autre')
                        ->label('Si Autre, précisez')
                        ->visible(fn ($get) => $get('nature1_inter') === 'Autre' ),  

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
                            }else{
                                $set('nature2_inter','') ; 
                            }
                        }),

                        Hidden::make('nature2_inter'), 

                        Forms\Components\Select::make('nature2_id')
                        ->label('Nature des Faits secondaire')
                        ->relationship('nature2','libelle', function ($query, callable $get) { 
                            $id = 1 ; 
                            $rub = $get('rub_nature2_id') ; 
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

                        Forms\Components\TextArea::make('nature2_autre')
                        ->label('Si Autre, précisez')
                        ->visible(fn ($get) => $get('nature2_inter') === 'Autre'),
                    ]), 
                    FilamentSection::make('Description des circonstances et déroulement des faits')
                    ->schema([
                        Placeholder::make(' ')
                        ->content('Date et heure des faits et leur constatation, circonstances'), 
                        Forms\Components\TextArea::make('description')
                        ->label('Description des circonstances et déroulement des faits')
                        ->helperText('Les informations saisies dans ce champ sont confidentielles')
                        ->requiredIf('complet',true),

                        Forms\Components\Grid::make(3)
                        ->schema([
                            Forms\Components\Radio::make('eig')
                            ->label('L\'EIG s\'est passé pendant une période tenue de l\'organisation ' )
                            ->options([
                                'Oui'=>'Oui',
                                'Non'=>'Non',
                            ])
                            ->default(null)
                            ->requiredIf('complet',true),
                            
                            Forms\Components\Select::make('periode_eig')
                            ->label('Période EIG')
                            ->options([
                                'Durant la nuit'=>'Durant la nuit',
                                'Durant le week-end'=>'Durant le week-end',
                                'Un jour férié'=>'Un jour férié',
                                'Heure de changement d\'équipe'=>'Heure de changement d\'équipe',
                                'Autre'=>'Autre',
                            ])
                            ->default(null)
                            ->requiredIf('complet',true)
                            ->reactive(),
                            
                            Forms\Components\TextInput::make('periode_eig_autre')
                            ->label('Si Autre, précisez')
                            ->visible(fn ($get) => $get('periode_eig') === 'Autre'),
                        ]),

                        Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('victimes_pec')
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
                            ->default(null)
                            ->requiredIf('complet',true),

                            Forms\Components\Select::make('perex_pec')
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
                        ]),

                        Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('victimes_pro')
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
                            ->default(null)
                            ->requiredIf('complet',true),

                            Forms\Components\Select::make('perex_pro')
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
                        ]),
                        
                        Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('victimes_autre')
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
                            ->default(null)
                            ->requiredIf('complet',true),

                            Forms\Components\Select::make('perex_autre')
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
                ]),
            Tab::make('Conséquences-Mesures')
                ->schema([
                    FilamentSection::make('Conséquences constatées au moment de la transmission d\'information')
                    ->schema([
                        Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('consequence1')
                            ->label('Pour la ou les personnes prises en charge')
                            ->relationship('consequences1', 'libelle', function ($query){
                                $sections = Section::all() ; 
                                $rubriques = Rubrique::all() ; 
                                foreach($sections as $ligne){
                                    if($ligne->libelle == "Conséquences")
                                    {
                                        $idSection = $ligne->id ; 
                                        break ;
                                    }
                                }
                                foreach($rubriques as $ligne){
                                    if($ligne->libelle == "Pour la ou les personnes prise(s) en charge"){
                                        $idRubrique = $ligne->id ; 
                                        break ; 
                                    }
                                }
                                $query->where('section_id', $idSection) 
                                ->where('rubrique_id', $idRubrique ) ; 
                                $query->orderBy('ordre','asc') ;
                            })
                            ->afterStateUpdated(function ($state, callable $set, callable $get){
                                $rubriques = Rubrique::all();
                                $sections = Section::all() ; 
                                $options = Option::all() ; 
                                foreach($sections as $ligne){
                                    if($ligne->libelle == "Conséquences")
                                    {
                                        $idSection = $ligne->id ; 
                                        break ;
                                    }
                                }
                                foreach($rubriques as $ligne){
                                    if($ligne->libelle == "Pour la ou les personnes prise(s) en charge"){
                                        $idRubrique = $ligne->id ; 
                                        break ; 
                                    }
                                }
                                $idOption = null ; 
                                foreach($options as $ligne){
                                    if($ligne->rubrique_id === $idRubrique && $ligne->section_id == $idSection && $ligne->libelle === "Autre"){
                                        $idOption = $ligne->id ;  
                                        break ; 
                                    }
                                }
                                if($state == $idOption){ 
                                    $set('consequence1_inter','Autre') ; 
                                }
                            })
                            ->reactive()
                            ->default(null)
                            ->requiredIf('complet',true),

                            Hidden::make('consequence1_inter'), 

                            Forms\Components\TextInput::make('consequence1_autre')
                            ->label('Si autre précisez')
                            ->visible(fn ($get) => $get('consequence1_inter') === 'Autre'),

                        ]),
                        Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('consequence2')
                            ->label('Pour la ou les personnes prises en charge')
                            ->relationship('consequences2', 'libelle', function ($query){
                                $sections = Section::all() ; 
                                $rubriques = Rubrique::all() ; 
                                foreach($sections as $ligne){
                                    if($ligne->libelle == "Conséquences")
                                    {
                                        $idSection = $ligne->id ; 
                                        break ;
                                    }
                                }
                                foreach($rubriques as $ligne){
                                    if($ligne->libelle == "Pour la ou les personnes prise(s) en charge"){
                                        $idRubrique = $ligne->id ; 
                                        break ; 
                                    }
                                }
                                $query->where('section_id', $idSection) 
                                ->where('rubrique_id', $idRubrique ) ; 
                                $query->orderBy('ordre','asc') ;
                            })
                            ->afterStateUpdated(function ($state, callable $set, callable $get){
                                $rubriques = Rubrique::all();
                                $sections = Section::all() ; 
                                $options = Option::all() ; 
                                foreach($sections as $ligne){
                                    if($ligne->libelle == "Conséquences")
                                    {
                                        $idSection = $ligne->id ; 
                                        break ;
                                    }
                                }
                                foreach($rubriques as $ligne){
                                    if($ligne->libelle == "Pour la ou les personnes prise(s) en charge"){
                                        $idRubrique = $ligne->id ; 
                                        break ; 
                                    }
                                }
                                $idOption = null ; 
                                foreach($options as $ligne){
                                    if($ligne->rubrique_id === $idRubrique && $ligne->section_id == $idSection && $ligne->libelle === "Autre"){
                                        $idOption = $ligne->id ;  
                                        break ; 
                                    }
                                }
                                if($state == $idOption){ 
                                    $set('consequence2_inter','Autre') ; 
                                }
                            })
                            ->reactive()
                            ->default(null)
                            ->requiredIf('complet',true),

                            Hidden::make('consequence2_inter'),

                            Forms\Components\TextInput::make('consequence2_autre')
                            ->label('Si autre précisez')
                            ->visible(fn ($get) => $get('consequence2') === 'Autre'),

                        ]),
                        Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('consequence3')
                            ->label('Pour la ou les personnes prises en charge')
                            ->relationship('consequences3', 'libelle', function ($query){
                                $sections = Section::all() ; 
                                $rubriques = Rubrique::all() ; 
                                foreach($sections as $ligne){
                                    if($ligne->libelle == "Conséquences")
                                    {
                                        $idSection = $ligne->id ; 
                                        break ;
                                    }
                                }
                                foreach($rubriques as $ligne){
                                    if($ligne->libelle == "Pour la ou les personnes prise(s) en charge"){
                                        $idRubrique = $ligne->id ; 
                                        break ; 
                                    }
                                }
                                $query->where('section_id', $idSection) 
                                ->where('rubrique_id', $idRubrique ) ; 
                                $query->orderBy('ordre','asc') ;
                            })
                            ->afterStateUpdated(function ($state, callable $set, callable $get){
                                $rubriques = Rubrique::all();
                                $sections = Section::all() ; 
                                $options = Option::all() ; 
                                foreach($sections as $ligne){
                                    if($ligne->libelle == "Conséquences")
                                    {
                                        $idSection = $ligne->id ; 
                                        break ;
                                    }
                                }
                                foreach($rubriques as $ligne){
                                    if($ligne->libelle == "Pour la ou les personnes prise(s) en charge"){
                                        $idRubrique = $ligne->id ; 
                                        break ; 
                                    }
                                }
                                $idOption = null ; 
                                foreach($options as $ligne){
                                    if($ligne->rubrique_id === $idRubrique && $ligne->section_id == $idSection && $ligne->libelle === "Autre"){
                                        $idOption = $ligne->id ;  
                                        break ; 
                                    }
                                }
                                if($state == $idOption){ 
                                    $set('consequence3_inter','Autre') ; 
                                }
                            })
                            ->reactive()
                            ->default(null)
                            ->requiredIf('complet',true),

                            Hidden::make('consequence3_inter'),

                            Forms\Components\TextInput::make('consequence3_autre')
                            ->label('Si autre précisez')
                            ->visible(fn ($get) => $get('consequence3') === 'Autre'),
                        ]),
                    ]), 
                    FilamentSection::make('Demande d\'intervention des secours')->schema([
                        Forms\Components\Grid::make('Demande d\'intervention des secours')
                        ->schema([
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
                                $rubriques = Rubrique::all() ; 
                                $id_non = null ;
                                $id_autre = null ; 
                                foreach($rubriques as $ligne){
                                    if($ligne['libelle'] == 'Demande d\'intervention des secours'){
                                        $rubrique_id = $ligne['id'] ;
                                    }
                                }
                                foreach($sections as $ligne){
                                    if($ligne['libelle'] == 'Non'){
                                        $id_non = $ligne['id'] ; 
                                    }
                                    if($ligne['libelle'] == 'Autre' && $ligne['rubrique_id'] === $rubrique_id){
                                        $id_autre = $ligne['id'] ; 
                                    }
                                }
                                if ($state == $id_autre) {
                                    $set('inter_secours_autre', 'Autre');
                                    // logger()->info('Test'); 
                                }else{
                                    $set('inter_secours_autre','');
                                }
                                if ($state == $id_non) {
                                    $set('inter_secours_non', 'Non');
                                }else{
                                    $set('inter_secours_non','');
                                }
                            })
                            ->reactive()
                            ->default(null)
                            ->requiredIf('complet',true),

                            Hidden::make('inter_secours_non')->reactive(), 
                            Hidden::make('inter_secours_autre')->reactive()
                            // ->afterStateUpdated(function ($state, callable $set, callable $get) {
                            //     logger()->info('inter_secours_autre : '.$state) ; 
                            // })
                            ,
                            Forms\Components\TextInput::make('secours_non')
                            ->label('Si Non, précisez')
                            ->visible(fn ($get) => $get('inter_secours_non') === 'Non'),

                            Forms\Components\TextInput::make('secours_autre')
                            ->label('Si Autre, précisez')
                            ->visible(fn ($get) => $get('inter_secours_autre') === 'Autre'),

                        ])->columns(2),

                        Grid::make('Liste des secours')
                        ->schema([
                            Forms\Components\CheckBox::make('secours_ide')
                            ->label('IDE (Infirmière Diplômée d\'Etat')
                            ->default(false)
                            ->requiredIf('complet',true),

                            Forms\Components\CheckBox::make('secours_medecin')
                            ->label('Médecin')
                            ->default(false)
                            ->requiredIf('complet',true),

                            Forms\Components\CheckBox::make('secours_medecin2')
                            ->label('Médecin traitant')
                            ->default(false)
                            ->requiredIf('complet',true),

                            Forms\Components\CheckBox::make('secours_police')
                            ->label('Police')
                            ->default(false)
                            ->requiredIf('complet',true),

                            Forms\Components\CheckBox::make('secours_samu')
                            ->label('SAMU')
                            ->default(false)
                            ->requiredIf('complet',true),

                            Forms\Components\CheckBox
                            ::make('secours_pompiers')
                            ->label('Pompiers')
                            ->default(false)
                            ->requiredIf('complet',true),
                        ])->columns(5),
                    ]),
                    FilamentSection::make('Mesures immédiates prises par l\'établissement')
                    ->schema([ 
                        Grid::make('Mesures immédiates prises par l\'établissement')
                        ->schema([
                        Forms\Components\TextArea::make('mesure1')
                        ->label('Pour protéger, accompagner ou soutenir les victimes ou personnes exposées - Les informations saisies dans ce champ sont confidentielles'),

                        Forms\Components\TextArea::make('mesure2')
                        ->label('Pour assurer la continuité de la prise en charge- Les informations saisies dans ce champ sont confidentielles'),
                        
                        Forms\Components\TextArea::make('mesure3')
                        ->label('A l\'égard des autres personnes prises en carge ou du personnel, le cas échéant - Les informations saisies dans ce champ sont confidentielles'),
                        ])->columns(2), 
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
                    ])->columns(5),
                ]), 
        Tab::make('Information-Dispositions')
            ->schema([
                FilamentSection::make('Informations aux proches, famille, et personnes concernées')
                ->schema([
                    Placeholder::make(' ')->content('Sous réserve d\'accord de la personne concernée selon la nature des faits'), 
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
                        ->default(null)
                        ->requiredIf('complet',true),

                        Forms\Components\TextInput::make('information_autre')
                        ->label('Si Autre, précisez')
                        ->visible(fn ($get)=>$get('information') === 'Autre' ),

                        Forms\Components\TextInput::make('information_plus')
                        ->label('Si Oui, précisez')
                        ->visible(fn ($get)=>$get('information') === 'Oui' ),

                        Forms\Components\TextInput::make('information_non')
                        ->label('Si Non, précisez')
                        ->visible(fn ($get)=>$get('information') === 'Non' ),

                        Forms\Components\TextInput::make('information_autre')
                        ->label('Si Autre, précisez')
                        ->visible(fn ($get)=>$get('information') === 'Autre' ),
                        ]), 
                        Grid::make('Destinataire')
                        ->schema([
                        Forms\Components\Select::make('destinataires')
                        ->relationship('destinataires','libelle', function($query){
                            $sections = Section::all() ; 
                            $rubriques = Rubrique::all() ; 

                            foreach($sections as $ligne){
                                if($ligne->libelle == "Informations"){
                                    $idSection = $ligne->id ; 
                                    break ; 
                                }
                            }

                            foreach($rubriques as $ligne){
                                if($ligne->libelle == "Information aux proches, familles et personnes concernées"){
                                    $idRubrique = $ligne->id ; 
                                }
                            }

                            $query->where('section_id',$idSection)
                            ->where('rubrique_id', $idRubrique)  
                            ->orderBy('ordre', 'asc') ; 
                        })
                        ->reactive()
                        ->multiple()
                        ->label('Destinataire'),

                        Forms\Components\TextInput::make('destinataire_autre')
                        ->label('Si Autre destinataire, précisez')
                        ->visible(fn ($get) => in_array('Autre', $get('destinataire_signalement') ?? [])),
                    
                    ])->columns(2),
                ]), 
                FilamentSection::make('Dispositions prises ou envisagées par l\'établissement')
                ->schema([
                    Grid::make()
                    ->schema([
                        Forms\Components\Select::make('disposition1')
                        ->relationship('dispositions1','libelle', function ($query){
                            $sections = Section::all() ; 
                            $rubriques = Rubrique::all() ; 
                            foreach($sections as $ligne){
                                if($ligne->libelle == "Dispositions")
                                {
                                    $idSection = $ligne->id ; 
                                    break ;
                                }
                            }
                            foreach($rubriques as $ligne){
                                if($ligne->libelle == "Concernant les usagers"){
                                    $idRubrique = $ligne->id ; 
                                    break ; 
                                }
                            }
                            $query->where('section_id', $idSection) 
                            ->where('rubrique_id', $idRubrique ) ; 
                            $query->orderBy('ordre','asc') ; 

                        })
                        ->afterStateUpdated(function ($state, callable $set, callable $get){
                            $rubriques = Rubrique::all();
                            $sections = Section::all() ; 
                            $options = Option::all() ; 
                            foreach($sections as $ligne){
                                if($ligne->libelle == "Dispositions")
                                {
                                    $idSection = $ligne->id ; 
                                    break ;
                                }
                            }
                            foreach($rubriques as $ligne){
                                if($ligne->libelle == "Concernant les usagers"){
                                    $idRubrique = $ligne->id ; 
                                    break ; 
                                }
                            }
                            $idOption = null ; 
                            foreach($options as $ligne){
                                if($ligne->rubrique_id === $idRubrique && $ligne->section_id == $idSection && $ligne->libelle === "Autre"){
                                    $idOption = $ligne->id ;  
                                    break ; 
                                }
                            }
                            for($ind = 0 ; $ind < count($state) ; $ind++){
                                if($state[$ind] == $idOption){ 
                                    $set('disposition1_inter','Autre') ; 
                                }
                            }
                        })
                        ->multiple()
                        ->reactive()
                        ->label('Concernant les usagers')
                        ->default(null)
                        ->requiredIf('complet',true),

                        Hidden::make('disposition1_inter')->reactive(), 
                        
                        Forms\Components\TextInput::make('disposition1_autre')
                        ->label('Si Autre, précisez')
                        ->visible(fn ($get) => $get('disposition1_inter') === 'Autre' ),

                    ]),

                    Grid::make()
                    ->schema([
                        Forms\Components\Select::make('disposition2')
                        ->relationship('dispositions2','libelle', function ($query){
                            $sections = Section::all() ; 
                            $rubriques = Rubrique::all() ; 
                            foreach($sections as $ligne){
                                if($ligne->libelle == "Dispositions")
                                {
                                    $idSection = $ligne->id ; 
                                    break ;
                                }
                            }
                            foreach($rubriques as $ligne){
                                if($ligne->libelle == "Concernant les professionnels"){
                                    $idRubrique = $ligne->id ; 
                                    break ; 
                                }
                            }
                            $query->where('section_id', $idSection) 
                            ->where('rubrique_id', $idRubrique ) ; 
                            $query->orderBy('ordre','asc') ; 

                        })
                        ->afterStateUpdated(function ($state, callable $set, callable $get){
                            $rubriques = Rubrique::all();
                            $sections = Section::all() ; 
                            $options = Option::all() ; 
                            foreach($sections as $ligne){
                                if($ligne->libelle == "Dispositions")
                                {
                                    $idSection = $ligne->id ; 
                                    break ;
                                }
                            }
                            foreach($rubriques as $ligne){
                                if($ligne->libelle == "Concernant les professionnels"){
                                    $idRubrique = $ligne->id ; 
                                    break ; 
                                }
                            }
                            $idOption = null ; 
                            foreach($options as $ligne){
                                if($ligne->rubrique_id === $idRubrique && $ligne->section_id == $idSection && $ligne->libelle === "Autre"){
                                    $idOption = $ligne->id ;  
                                    break ; 
                                }
                            }
                            for($ind = 0 ; $ind < count($state) ; $ind++){
                                if($state[$ind] == $idOption){ 
                                    $set('disposition2_inter','Autre') ; 
                                }
                            }
                        })
                        ->multiple()
                        ->reactive()
                        ->label('Concernant les professionnels')
                        ->default(null)
                        ->requiredIf('complet',true),

                        Hidden::make('disposition2_inter')->reactive(), 
                        
                        Forms\Components\TextInput::make('disposition2_autre')
                        ->label('Si Autre, précisez')
                        ->visible(fn ($get)=> $get('disposition2_inter') === 'Autre'),

                    ]),

                    Grid::make()
                    ->schema([
                        Forms\Components\Select::make('disposition3')
                        ->relationship('dispositions3','libelle', function ($query){
                            $sections = Section::all() ; 
                            $rubriques = Rubrique::all() ; 
                            foreach($sections as $ligne){
                                if($ligne->libelle == "Dispositions")
                                {
                                    $idSection = $ligne->id ; 
                                    break ;
                                }
                            }
                            foreach($rubriques as $ligne){
                                if($ligne->libelle == "Concernant l'organisation de travail"){
                                    $idRubrique = $ligne->id ; 
                                    break ; 
                                }
                            }
                            $query->where('section_id', $idSection) 
                            ->where('rubrique_id', $idRubrique ) ; 
                            $query->orderBy('ordre','asc') ; 

                        })
                        ->afterStateUpdated(function ($state, callable $set, callable $get){
                            $rubriques = Rubrique::all();
                            $sections = Section::all() ; 
                            $options = Option::all() ; 
                            foreach($sections as $ligne){
                                if($ligne->libelle == "Dispositions")
                                {
                                    $idSection = $ligne->id ; 
                                    break ;
                                }
                            }
                            foreach($rubriques as $ligne){
                                if($ligne->libelle == "Concernant l'organisation de travail"){
                                    $idRubrique = $ligne->id ; 
                                    break ; 
                                }
                            }
                            $idOption = null ; 
                            foreach($options as $ligne){
                                if($ligne->rubrique_id === $idRubrique && $ligne->section_id == $idSection && $ligne->libelle === "Autre"){
                                    $idOption = $ligne->id ;  
                                    break ; 
                                }
                            }
                            for($ind = 0 ; $ind < count($state) ; $ind++){
                                if($state[$ind] == $idOption){ 
                                    $set('disposition3_inter','Autre') ; 
                                }
                            }
                        })
                        ->multiple()
                        ->reactive()
                        ->label('Concernant l\'organisation de travail')
                        ->default(null)
                        ->requiredIf('complet',true),

                        Hidden::make('disposition3_inter')->reactive(), 
                        
                        Forms\Components\TextInput::make('disposition3_autre')
                        ->label('Si Autre, précisez')
                        ->visible(fn ($get)=> in_array('Autre', $get('disposition3') ?? [])  ),
                    ]),     

                    Grid::make()
                    ->schema([
                        Forms\Components\Select::make('disposition4')
                        ->relationship('dispositions4','libelle', function ($query){
                            $sections = Section::all() ; 
                            $rubriques = Rubrique::all() ; 
                            foreach($sections as $ligne){
                                if($ligne->libelle == "Dispositions")
                                {
                                    $idSection = $ligne->id ; 
                                    break ;
                                }
                            }
                            foreach($rubriques as $ligne){
                                if($ligne->libelle == "Concernant l'établissement"){
                                    $idRubrique = $ligne->id ; 
                                    break ; 
                                }
                            }
                            $query->where('section_id', $idSection) 
                            ->where('rubrique_id', $idRubrique ) ; 
                            $query->orderBy('ordre','asc') ; 

                        })
                        ->afterStateUpdated(function ($state, callable $set, callable $get){
                            $rubriques = Rubrique::all();
                            $sections = Section::all() ; 
                            $options = Option::all() ; 
                            foreach($sections as $ligne){
                                if($ligne->libelle == "Dispositions")
                                {
                                    $idSection = $ligne->id ; 
                                    break ;
                                }
                            }
                            foreach($rubriques as $ligne){
                                if($ligne->libelle == "Concernant l'établissement"){
                                    $idRubrique = $ligne->id ; 
                                    break ; 
                                }
                            }
                            $idOption = null ; 
                            foreach($options as $ligne){
                                if($ligne->rubrique_id === $idRubrique && $ligne->section_id == $idSection && $ligne->libelle === "Autre"){
                                    $idOption = $ligne->id ;  
                                    break ; 
                                }
                            }
                            for($ind = 0 ; $ind < count($state) ; $ind++){
                                if($state[$ind] == $idOption){ 
                                    $set('disposition4_inter','Autre') ; 
                                }
                            }
                        })
                        ->multiple()
                        ->reactive()
                        ->label('Concernant l\'établissement')
                        ->default(null)
                        ->requiredIf('complet',true),

                        Hidden::make('disposition4_inter')->reactive(), 

                        Forms\Components\TextInput::make('disposition4_autre')
                        ->label('Si Autre, précisez')
                        ->visible(fn ($get)=> in_array('Autre', $get('disposition4') ?? [])  ),
                    ]),  
                ]),
            ]),
        Tab::make('Suites-Répercutions')
            ->schema([
                FilamentSection::make('Suites administratives ou judiciaires')
                ->schema([
                    Grid::make()
                    ->schema([
                        Forms\Components\Radio::make('suite1')
                        ->label('Enquête de Police ou de Gendarmerie')
                        ->options([
                            'Oui'=>'Oui',
                            'Non'=>'Non',
                        ])
                        ->default(null)
                        ->requiredIf('complet',true),
                        
                        Forms\Components\Radio::make('suite2')
                        ->label('Dépôt de plainte')
                        ->options([
                            'Oui'=>'Oui',
                            'Non'=>'Non',
                        ])
                        ->default(null)
                        ->requiredIf('complet',true),

                        Forms\Components\Radio::make('suite3')
                        ->label('Signalement au Procureur de la République')
                        ->options([
                            'Oui'=>'Oui',
                            'Non'=>'Non',
                        ])
                        ->default(null)
                        ->requiredIf('complet',true),
                    ]),
                ]), 
                FilamentSection::make('Evolution prévisibles ou difficultés attendues')
                ->schema([
                    Forms\Components\TextArea::make('evolution')
                    ->label('évolutions prévisible ou difficultés attendues, les informations saisies dans ce champ sont confidentielles'),
                ]), 

                FilamentSection::make('Répercutions médiatiques')
                ->schema([
                    Grid::make()
                    ->schema([
                        Forms\Components\Radio::make('media1')
                        ->label('L\'évènement peut-il avoir un impact médiatique ?')
                        ->options([
                            'Oui'=>'Oui',
                            'Non'=>'Non',
                        ])
                        ->reactive()
                        ->default(null)
                        ->requiredIf('complet',true),
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
                        ->default(null)
                        ->requiredIf('complet',true),
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
                        ->default(null)
                        ->requiredIf('complet',true),
                        Forms\Components\TextInput::make('media3_oui')
                        ->label('Si oui, précisez par qui ? quand ? comment ?')
                        ->visible(fn ($get) => $get('media3') === 'Oui'),
                    ]),
                ]), 
            ]),
            Tab::make('Suivi')
            ->schema([
                FilamentSection::make('Suivi de l\'évènement jusqu\'à sa résolution')
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
                        'Oui' => 'Oui',
                        'Non'=>'Non',
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
                        ->afterStateUpdated(function ($state, callable $set, callable $get) 
                        {
                            $options = Option::all() ; 
                            $rubriques = Rubrique::all() ; 
                            $sections = Section::all() ; 

                            foreach($rubriques as $ligne){
                                if($ligne['libelle'] === 'Groupe d\'analyse' ){
                                    $rubrique_id = $ligne['id'] ; 
                                }
                            }

                            foreach($sections as $ligne){
                                if($ligne['libelle'] === 'Analyse' ){
                                    $section_id = $ligne['id'] ; 
                                    print_r('section id' , $section_id) ; 
                                }
                            }
                
                            foreach($options as $ligne){
                                if($ligne['libelle'] === 'Autre' && $ligne['section_id'] === $section_id && $ligne['rubrique_id'] === $rubrique_id){
                                    $option_id = $ligne['id'] ; 
                                }
                            }

                            if($state == $option_id){
                                $set('groupe_inter','Autre') ;
                            }else{
                                $set('groupe_inter','') ; 
                            } ; 
                        })
                        ->reactive(),

                        Hidden::make('groupe_inter')
                        ->reactive(), 

                        Forms\Components\TextInput::make('analyse_group_autre')
                        ->label('Si Autre, précisez')
                        ->visible(fn ($get)=>$get('groupe_inter') === 'Autre'),
                    ]),

                    Forms\Components\TextArea::make('commentaire'),
                ]),
            ]), 
        ])
        ]) ;
    }
}