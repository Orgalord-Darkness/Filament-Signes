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
                    return "<p style='font-size:14px;'>Aucune action</p>" ; 
                }
            })
            ->wrap()
            ->html(), 
        ] ; 
    }
}