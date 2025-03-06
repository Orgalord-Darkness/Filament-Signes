<?php

namespace App\Filament\Widgets;
use App\Models\Signalement ; 
use App\Models\Rubrique ; 

use Filament\Widgets\ChartWidget;

class PaSignalementCategorieNatureWidget extends ChartWidget
{
    protected static ?string $heading = 'Personnes Agees - Nb de signalements par Catégorie Nature des faits';

    protected static ?string $pollingInterval = null ; 

    protected function getData(): array
    {
        $rubs = Rubrique::all();

        $annee = $this->filters['annee'] ?? null;
        $directionId = $this->filters['direction'] ?? null;

        foreach ($rubs as $ligne) {
            $query = Signalement::join('secteurs', 'signalements.secteur_id', '=', 'secteurs.id')
            ->join('rubriques', 'signalements.rub_nature1_id', '=', 'rubriques.id')
            ->where('rubriques.id', $ligne->id)
            ->where('secteurs.libelle', 'Personnes Agées')
            ->select('signalements.*')
            ->get();

            if (!empty($annee)) {
                $query = $query->where('created_at', '>=', $annee.'-01-01')->where('created_at', '<',  $annee.'-12-31');
            }

            if (!empty($directionId)) {
                $query = $query->where('direction_id', $directionId);
            }
            $datas[] = $query->count();
            $colors[] = 'rgb('.rand(0, 255).','.rand(0, 255).','.rand(0, 255).')';
            $libelles[] = $ligne->libelle;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Nb Signalement',
                    'data'  => $datas,
                    'backgroundColor'=>$colors, 
                    // 'backgroundColor'=>[
                    //     "#FF0000",
                    //     "#00FF00",
                    //     "#0000FF",
                    //     "#FFFF00",
                    //     "#00FFFF",
                    //     "#FF00FF",
                    //     "#000000",
                    //     "#FFFFFF",
                    //     "#808080",
                    //     "#FFA500"
                    // ],
                    'borderColor'     => 'rgb(255, 255, 255)',
                ],
            ],
            'labels' => $libelles,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
