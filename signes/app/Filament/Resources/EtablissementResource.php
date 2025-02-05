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

                Select::make('commune_id')
                //->relationship('commune', 'libelle')
                ->options(
                    [
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
                        "95062" => "Bezons",
                        "95063" => "Boisemont",
                        "95064" => "Boissy-l'Aillerie",
                        "95065" => "Bonneuil-en-France",
                        "95066" => "Bouffémont",
                        "95067" => "Bouqueval",
                        "95068" => "Bray-et-Lû",
                        "95069" => "Bréançon",
                        "95070" => "Brignancourt",
                        "95071" => "Bruyères-sur-Oise",
                        "95072" => "Buhy",
                        "95073" => "Butry-sur-Oise",
                        "95074" => "Cergy",
                        "95075" => "Champagne-sur-Oise",
                        "95076" => "La Chapelle-en-Vexin",
                        "95077" => "Charmont",
                        "95078" => "Chars",
                        "95079" => "Châtenay-en-France",
                        "95080" => "Chaumontel",
                        "95081" => "Chaussy",
                        "95082" => "Chauvry",
                        "95083" => "Chennevières-lès-Louvres",
                        "95084" => "Chérence",
                        "95085" => "Cléry-en-Vexin",
                        "95086" => "Commeny",
                        "95087" => "Condécourt",
                        "95088" => "Cormeilles-en-Parisis",
                        "95089" => "Cormeilles-en-Vexin",
                        "95090" => "Courcelles-sur-Viosne",
                        "95091" => "Courdimanche",
                        "95092" => "Deuil-la-Barre",
                        "95093" => "Domont",
                        "95094" => "Eaubonne",
                        "95095" => "Écouen",
                        "95096" => "Enghien-les-Bains",
                        "95097" => "Ennery",
                        "95098" => "Épiais-lès-Louvres",
                        "95099" => "Épiais-Rhus",
                        "95100" => "Épinay-Champlâtreux",
                        "95101" => "Éragny",
                        "95102" => "Ermont",
                        "95103" => "Ézanville",
                        "95104" => "Fontenay-en-Parisis",
                        "95105" => "Fosses",
                        "95106" => "Franconville",
                        "95107" => "Frémainville",
                        "95108" => "Frémécourt",
                        "95109" => "Frépillon",
                        "95110" => "La Frette-sur-Seine",
                        "95111" => "Frouville",
                        "95112" => "Garges-lès-Gonesse",
                        "95113" => "Genainville",
                        "95114" => "Génicourt",
                        "95115" => "Gonesse",
                        "95116" => "Goussainville",
                        "95117" => "Grisy-les-Plâtres",
                        "95118" => "Groslay",
                        "95119" => "Guiry-en-Vexin",
                        "95120" => "Haravilliers",
                        "95121" => "Haute-Isle",
                        "95122" => "Le Heaulme",
                        "95123" => "Hédouville",
                        "95124" => "Herblay-sur-Seine",
                        "95125" => "Hérouville-en-Vexin",
                        "95126" => "Hodent",
                        "95127" => "L'Isle-Adam",
                        "95128" => "Jagny-sous-Bois",
                        "95129" => "Jouy-le-Moutier",
                        "95130" => "Labbeville",
                        "95131" => "Lassy",
                        "95132" => "Livilliers",
                        "95133" => "Longuesse",
                        "95134" => "Louvres",
                        "95135" => "Luzarches",
                        "95136" => "Maffliers",
                        "95137" => "Magny-en-Vexin",
                        "95138" => "Mareil-en-France",
                        "95139" => "Margency",
                        "95140" => "Marines",
                        "95141" => "Marly-la-Ville",
                        "95142" => "Maudétour-en-Vexin",
                        "95143" => "Menouville",
                        "95144" => "Menucourt",
                        "95145" => "Mériel",
                        "95146" => "Méry-sur-Oise",
                        "95147" => "Le Mesnil-Aubry",
                        "95148" => "Moisselles",
                        "95149" => "Montgeroult",
                        "95150" => "Montigny-lès-Cormeilles",
                        "95151" => "Montlignon",
                        "95152" => "Montmagny",
                        "95153" => "Montmorency",
                        "95154" => "Montreuil-sur-Epte",
                        "95155" => "Montsoult",
                        "95156" => "Mours",
                        "95157" => "Moussy",
                        "95158" => "Nerville-la-Forêt",
                        "95159" => "Nesles-la-Vallée",
                        "95160" => "Neuilly-en-Vexin",
                        "95161" => "Neuville-sur-Oise",
                        "95162" => "Nointel",
                        "95163" => "Noisy-sur-Oise",
                        "95164" => "Nucourt",
                        "95165" => "Omerville",
                        "95166" => "Osny",
                        "95167" => "Parmain",
                        "95168" => "Persan",
                        "95169" => "Pierrelaye",
                        "95170" => "Piscop",
                        "95171" => "La Roche-Guyon",
                        "95172" => "Roissy-en-France",
                        "95173" => "Ronquerolles",
                        "95174" => "Sagy",
                        "95175" => "Saint-Brice-sous-Forêt",
                        "95176" => "Saint-Clair-sur-Epte",
                        "95177" => "Saint-Cyr-en-Arthies",
                        "95178" => "Saint-Gervais",
                        "95179" => "Saint-Gratien",
                        "95180" => "Saint-Leu-la-Forêt",
                        "95181" => "Saint-Martin-du-Tertre",
                        "95182" => "Saint-Ouen-l'Aumône",
                        "95183" => "Saint-Prix",
                        "95184" => "Sannois",
                        "95185" => "Santeuil",
                        "95186" => "Sarcelles",
                        "95187" => "Seugy",
                        "95188" => "Soisy-sous-Montmorency",
                        "95189" => "Survilliers",
                        "95190" => "Taverny",
                        "95191" => "Théméricourt",
                        "95192" => "Us",
                        "95193" => "Valmondois",
                        "95194" => "Vauréal",
                        "95195" => "Vémars",
                        "95196" => "Vétheuil",
                        "95197" => "Viarmes",
                        "95198" => "Vienne-en-Arthies",
                        "95199" => "Vigny",
                        "95200" => "Villaines-sous-Bois",
                        "95201" => "Villeron",
                        "95202" => "Villiers-Adam",
                        "95203" => "Villiers-le-Bel",
                        "95203" => "Villiers-le-Bel",
                        "95204" => "Villers-en-Arthies",
                        "95205" => "Villetaneuse",
                        "95206" => "Wy-dit-Joli-Village"
                    ]
                )
                ->required(),  

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
            'index' => Pages\ListEtablissements::route('/'),
            'create' => Pages\CreateEtablissement::route('/create'),
            'edit' => Pages\EditEtablissement::route('/{record}/edit'),
        ];
    }
}
