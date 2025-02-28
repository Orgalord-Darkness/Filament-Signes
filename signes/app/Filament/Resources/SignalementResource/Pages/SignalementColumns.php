<?php 

namespace App\Filament\Resources\SignalementResource\Pages ; 

use App\Enums\SignalementEtatEnum ; 
use Filament\Tables\Columns\TextColumn ; 
use Filament\Tables ; 
use App\Models\ActionSignalement ; 

class SignalementColumns 
{
    public static function getColumns(): array {
        return [
            //
            Tables\Columns\TextColumn::make('id')
            ->label('N°')
            ->searchable()
            ->sortable()
            ->wrap(),
            TextColumn::make('created_at')->label('Créer à ')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')->label('Dernière modification le : ')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('date')->label('Publier le')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true), 
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

            TextColumn::make('statut')->label('Statut : ')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('type')->label('Type : ')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('competence')->label('Competence : ')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('categories.libelle')->label('Catégorie : ')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('commune.libelle')->label('Commune : ')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('territoire')->label('Territoire : ')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('etat')
            ->searchable()
            ->sortable()
            ->toggleable()
            ->badge()
            ->color(static function($state): string { 
                if($state === SignalementEtatEnum::OUVERT->getLabel()){
                    return 'danger' ; 
                }
                if($state === SignalementEtatEnum::FERME->getLabel()){
                    return 'dark' ; 
                }
                if($state === SignalementEtatEnum::RECEPTIONNE->getLabel()){
                    return 'info' ; 
                }
                if($state === SignalementEtatEnum::RELANCE->getLabel()){
                    return 'warning' ; 
                }
                if($state === SignalementEtatEnum::ENCOURS->getLabel()){
                    return 'success' ; 
                }
                return 'dark' ; 
            })
            ->icon(static function($state): string {
                if($state === SignalementEtatEnum::OUVERT->getLabel())
                {
                    return SignalementEtatEnum::OUVERT->getIcon() ; 
                }
                if($state === SignalementEtatEnum::FERME->getLabel())
                {
                    return SignalementEtatEnum::FERME->getIcon() ; 
                }
                if($state === SignalementEtatEnum::RELANCE->getLabel())
                {
                    return SignalementEtatEnum::RELANCE->getIcon() ; 
                }
                if($state === SignalementEtatEnum::RECEPTIONNE->getLabel())
                {
                    return SignalementEtatEnum::RECEPTIONNE->getIcon() ; 
                }
                if($state === SignalementEtatEnum::ENCOURS->getLabel())
                {
                    return SignalementEtatEnum::ENCOURS->getIcon() ; 
                }
                return ''; 
            })
            ->wrap(),

            Tables\Columns\TextColumn::make('complet')
            ->formatStateUsing(function ($state) {
                return $state ? 'Oui' : 'Non';
            })
            ->searchable()
            ->sortable()
            ->toggleable()
            ->badge()
            ->color(static function($state): string { 
                if($state === true){
                    return 'success' ;
                }
                if($state === false){
                    return 'danger' ; 
                }
                return 'dark' ; 
            })
            ->wrap(),

            Tables\Columns\TextColumn::make('public')
            ->searchable()
            ->sortable()
            ->wrap(),
            TextColumn::make('civilite')->label('Civilité du signalant')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('prenom')->label('Prénom')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('nom')->label('Nom')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('email')->label('Email')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('tel')->label('Teléphone')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('fonction.libelle')->label('Fonction')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('ars_info')->label('Info ARS')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('ddpp_info')->label('Info DDPP')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('dtpjj_info')->label('Info DTPJJ')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('prefet_info')->label('Info Prefet')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('rub_nature1.libelle')->label('Rubrique Nature des faits')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('nature1.libelle')->label('Nature des faits')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('nature1_autre')->label('Autre nature des faits')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('rub_nature2.libelle')->label('Rubrique nature des faits secondaires')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('nature2.libelle')->label('Nature des faits secondaires')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('nature2_autre')->label('Autre nature des faits secondaires')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('description')->label('Description')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('eig')->label('Eig')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('periode_eig')->label('Période')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('periode_eig_autre')->label('Autre période')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('victimes_pec')->label('Victime prise en charge')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('victimes_pro')->label('Victimes Professionnels')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('victimes_autre')->label('Autre victimes')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('perex_pec')->label('Perex prise en charge')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('perx_pro')->label('Perex professionnel')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('perex_autre')->label('Perex Autre')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('consequence1_autre')->label('Conséquence Prise en charge autre')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('consequence2_autre')->label('Conséquence Pro autre')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('consequence3_autre')->label('Conséquence autre')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('secours.libelle')->label('Demande de secours')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('secours_ide')->label('Infirmière Diplômée d\'Etat')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('secours_medecin')->label('Médecin')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('secours_medecin2')->label('Médecin autre')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('secours_police')->label('Police')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('secours_non')->label('Refus de secours')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('secours_autre')->label('Alternative au secours')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('mesure1')->label('1ere mesure')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('mesure2')->label('2eme mesure')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('mesure3')->label('3eme mesure')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('mesure3_info')->label('Information à l\'ensemble du personnel')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('mesure3_soutien')->label('Soutien psychologique')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('mesure3_reunion')->label('Réunion entre la direction et l\'équipe concernée')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('information')->label('Information')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('information_non')->label('Raison refus d\'information')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('information_autre')->label('Autre information')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('disposition1_autre')->label('Autres disposition concernant les usagers')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('disposition2_autre')->label('Autes dispositions concernant les professionnels')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('disposition3_autre')->label('Autres dispositions concernant l\'organisation du travail')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('disposition4_autre')->label('Autres dispositions concernant l\'établissement')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('suite1')->label('Enquête de police')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('suite2')->label('Dépôt de plainte')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('suite3')->label('Signalement au procureur de la République')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('evolution')->label('Evolution')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('media1')->label('Impact médiatique')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('media1_oui')->label('Détails')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('media2')->label('Les médias sont-ils informés')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('media2_oui')->label('Détails')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('media3')->label('Communication effectuée ou prévue')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('media3_oui')->label('Détails')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('maitrise')->label('L\'évènement est-il maîtrisé')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('analyse')->label('Analyse')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('analyse_car_event')->label('Qualification analyse')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('analyse_collect')->label('Analyse collective')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('analyse_groupe.libelle')->label('Groupe d\'analyse')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('analyse_groupe_autre')->label('Groupe autre')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('commentaire')->label('Commentaire')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('user.nom')->label('Signalant')->searchable()->sortable()->wrap()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('actions_count')
            ->label('Nb Actions')
            ->counts('actions')
            ->sortable()
            ->searchable()
            ->wrap()

            // Tables\Columns\TextColumn::make('actions')
            //->label('Voir Actions')
            ->formatStateUsing(function ($record){
                $list = [] ; 
                $actions_signalements = ActionSignalement::all() ; 
                foreach($actions_signalements as $ligne)
                {
                    if($ligne['signalement_id'] == $record->id)
                    {
                        $action_id = $ligne['signalement_id'] ; 
                        $list[] = $action_id ;
                        
                    }
                }
                if(!empty($list) == true){
                    for($ind=0 ; $ind < count($list) ; $ind++){
                        $url = '/admin/action-signalements?tableFilters[Signalement][value]='.$action_id  ;
                        $n = $ind+1 ; 
                        //return "Nb:".count($list)."<a style='font-size:14px;' class='warning'href='$url'>Action N°".$n."</a>" ; Version avec nombre total d'actions 
                        return "<a style='font-size:14px;' class='text-center warning'href='$url'>Action N°".$n."</a>" ; 
                    }
                }else{
                    return "<a style='font-size:14px;' class='text-center warning'href='/admin/action-signalements/create'>Ajouter une action</a>" ; 
                }
            })
            ->wrap()
            ->html(), 
        ] ; 
    }
}