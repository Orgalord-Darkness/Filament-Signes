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

class EtablissementResource extends Resource
{
    protected static ?string $model = Etablissement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('delos')->label('Identifiant DELOS')->required(), 
                Forms\Components\TextInput::make('nom')->required(),

                Select::make('secteur_id')
                    ->relationship('secteur', 'libelle')
                    ->required(),
                    
                Select::make('categorie_id')
                    ->relationship('categorie', 'libelle')
                    ->required(),   

                Select::make('statut')
                    ->options([
                        'ASSO' => 'Association',
                        'HOSP'=> 'Hôpital',
                        'PRIVE'=> 'Privé',
                    ])
                    ->required(),    

                Select::make('type')
                    ->options([
                        'ET' => 'Etablissement',
                        'SE' => 'Service',
                        'STF' => 'Structure non tarifée',
                ]),

                Select::make('competence')
                    ->options([
                        'CD' => 'Département VO',
                        'CDARS' => 'Département - Agence Régionale de Santé',
                        'CDDPJJ' => 'Département - DPJJ',
                        '' => 'Hors département VO',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('adresse')->required(),
                Forms\Components\TextInput::make('adresse2')->label('Complément adresse'),

                Select::make('commune')->label('Commune')
                ->required()  
                ->live()
                // ->options(function (CommuneRepository $repository): array{
                //     return $repository->getCommunes()->pluck('libelle','insee')->toArray();
                // }),
                ->options([
                    "95002" => "Ableiges",
                    "95008" => "Aincourt",
                    "95011" => "Ambleville",
                    "95012" => "Amenucourt",
                    "95014" => "Andilly",
                    "95018" => "Argenteuil",
                    "95019" => "Arnouville",
                    "95023" => "Arronville",
                    "95024" => "Arthies",
                    "95026" => "Asnières-sur-Oise",
                    "95028" => "Attainville",
                    "95039" => "Auvers-sur-Oise",
                    "95040" => "Avernes",
                    "95042" => "Baillet-en-France",
                    "95046" => "Banthelu",
                    "95051" => "Beauchamp",
                    "95052" => "Beaumont-sur-Oise",
                    "95054" => "Le Bellay-en-Vexin",
                    "95055" => "Bellefontaine",
                    "95056" => "Belloy-en-France",
                    "95058" => "Bernes-sur-Oise",
                    "95059" => "Berville",
                    "95060" => "Bessancourt",
                    "95061" => "Béthemont-la-Forêt",
                    "95063" => "Bezons",
                    "95074" => "Boisemont",
                    "95078" => "Boissy-l'Aillerie",
                    "95088" => "Bonneuil-en-France",
                    "95091" => "Bouffémont",
                    "95094" => "Bouqueval",
                    "95101" => "Bray-et-Lû",
                    "95102" => "Bréançon",
                    "95103" => "Brignancourt",
                    "95104" => "Buhy",
                    "95106" => "Butry-sur-Oise",
                    "95108" => "Cergy",
                    "95109" => "Champagne-sur-Oise",
                    "95110" => "Champagne-sur-Oise",
                    "95111" => "Châtenay-en-France",
                    "95112" => "Chauvry",
                    "95113" => "Chaussy",
                    "95114" => "Chennevières-lès-Louvres",
                    "95115" => "Chérence",
                    "95116" => "Cléry-en-Vexin",
                    "95117" => "Cormeilles-en-Parisis",
                    "95118" => "Cormeilles-en-Vexin",
                    "95119" => "Courcelles-sur-Viosne",
                    "95120" => "Deuil-la-Barre",
                    "95121" => "Domont",
                    "95122" => "Écouen",
                    "95123" => "Épiais-Rhus",
                    "95124" => "Éragny",
                    "95125" => "Ézanville",
                    "95126" => "Fosses",
                    "95127" => "Foulangues",
                    "95128" => "Frette-sur-Seine",
                    "95129" => "Frémainville",
                    "95130" => "Frémécourt",
                    "95131" => "Frouville",
                    "95132" => "Gadancourt",
                    "95133" => "Genainville",
                    "95134" => "Génicourt",
                    "95135" => "Gonesse",
                    "95136" => "Goussainville",
                    "95137" => "Gouzangrez",
                    "95138" => "Grisy-les-Plâtres",
                    "95139" => "Groslay",
                    "95140" => "Guiry-en-Vexin",
                    "95141" => "Haravilliers",
                    "95142" => "Hérouville-en-Vexin",
                    "95143" => "Hodent",
                    "95144" => "L'Isle-Adam",
                    "95145" => "Labbeville",
                    "95146" => "Lassy",
                    "95147" => "Le Heaulme",
                    "95148" => "Le Mesnil-Aubry",
                    "95149" => "Le Plessis-Bouchard",
                    "95150" => "Le Plessis-Gassot",
                    "95151" => "Le Thillay",
                    "95152" => "Le Val-d'Hazey",
                    "95153" => "Le Vauroux",
                    "95154" => "Livilliers",
                    "95155" => "Longuesse",
                    "95156" => "Louvres",
                    "95157" => "Magny-en-Vexin",
                    "95158" => "Maudétour-en-Vexin",
                    "95159" => "Mareil-en-France",
                    "95160" => "Maffliers",
                    "95161" => "Marines",
                    "95162" => "Mériel",
                    "95163" => "Méry-sur-Oise",
                    "95164" => "Montgeroult",
                    "95165" => "Montigny-lès-Cormeilles",
                    "95166" => "Montlignon",
                    "95167" => "Montsoult",
                    "95168" => "Montreuil-sur-Epte",
                    "95169" => "Montigny",
                    "95170" => "Mours",
                    "95171" => "Nerville-la-Forêt",
                    "95172" => "Neuilly-en-Vexin",
                    "95173" => "Neuville-sur-Oise",
                    "95174" => "Nointel",
                    "95175" => "Nucourt",
                    "95176" => "Omerville",
                    "95177" => "Osny",
                    "95178" => "Parmain",
                    "95179" => "Persan",
                    "95180" => "Pierrelaye",
                    "95181" => "Piscop",
                    "95182" => "Pontoise",
                    "95183" => "Presles",
                    "95184" => "Puiseux-en-France",
                    "95185" => "Puiseux-Pontoise",
                    "95186" => "Roncourt",
                    "95187" => "Roissy-en-France",
                    "95188" => "Ronquerolles",
                    "95189" => "Sagy",
                    "95190" => "Saint-Brice-sous-Forêt",
                    "95191" => "Saint-Clair-sur-Epte",
                    "95192" => "Saint-Cyr-en-Arthies",
                    "95193" => "Saint-Gervais",
                    "95194" => "Saint-Gratien",
                    "95195" => "Saint-Leu-la-Forêt",
                    "95196" => "Saint-Martin-du-Tertre",
                    "95197" => "Saint-Ouen-l'Aumône",
                    "95198" => "Sannois",
                    "95199" => "Santeuil",
                    "95200" => "Sarcelles",
                    "95201" => "Seugy",
                    "95202" => "Soisy-sous-Montmorency",
                    "95203" => "Survilliers",
                    "95204" => "Taverny",
                    "95205" => "Theuville",
                    "95206" => "Us",
                    "95207" => "Valmondois",
                    "95208" => "Vauréal",
                    "95209" => "Vémars",
                    "95210" => "Vétheuil",
                    "95211" => "Viarmes",
                    "95212" => "Vienne-en-Arthies",
                    "95213" => "Villaines-sous-Bois",
                    "95214" => "Villeron",
                    "95215" => "Villiers-Adam",
                    "95216" => "Villiers-le-Bel",
                    "95217" => "Villiers-le-Sec",
                    "95218" => "Vineuil-Saint-Firmin",
                    "95219" => "Wy-dit-Joli-Village",
                    "95220" => "Écouen",
                    "95221" => "Épiais-lès-Louvres",
                    "95222" => "Épiais-Rhus",
                    "95223" => "Éragny",
                    "95224" => "Ézanville",
                ]
                ),
                Forms\Components\TextInput::make('territoire')->disabled(),
                Forms\Components\TextInput::make('tel')->label('Téléphone'),
                Forms\Components\TextInput::make('email')->email(),

                Select::make('gestionnaire_id')
                ->relationship('gestionnaire', 'nom'),  

                CheckBox::make('actif')
                        ->label('Actif')
                        ->required(), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom'),
                Tables\Columns\TextColumn::make('secteur.libelle'),
                Tables\Columns\TextColumn::make('categorie.code'),
                Tables\Columns\TextColumn::make('statut'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('competence'),
                Tables\Columns\TextColumn::make('commune_id'),
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
}
