<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Signalement ; 
use App\Models\Secteur ; 
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class SignalementSecteurWidget extends ChartWidget
{
    use InteractsWithPageFilters ; 

    protected static ?string $heading = 'Nombre de signalements par secteur';

    protected function getData(): array
    {
        $secteurs = Secteur::all();

        $annee = $this->filters['annee'] ?? null;
        $directionId = $this->filters['direction'] ?? null;

        foreach ($secteurs as $ligne) {
            $query = Signalement::where('secteur_id', $ligne->id);

            if (!empty($annee)) {
                $query = $query->where('created_at', '>=', $annee.'-01-01')->where('created_at', '<',  $annee.'-12-31');
            }
            $datas[] = $query->count();
            $colors[] = 'rgb('.rand(0, 255).','.rand(0, 255).','.rand(0, 255).')';
            $libelles[] = $ligne->libelle;
        }
        return 
        [
            'datasets' => [  
                [          
                    'label' =>'Nb Signalements', 
                    'data' => $datas, 
                    //'backgroundColor'=>$colors, 
                    'backgroundColor'=>[
                        "#FF0000",
                        "#00FF00",
                        "#0000FF",
                        "#FFFF00",
                        "#00FFFF",
                        "#FF00FF",
                        "#000000",
                        "#FFFFFF",
                        "#808080",
                        "#FFA500"
                    ], 
                    'borderColor'=> 'rgb(255,255,255)', 
                ],
            ],
            'labels' => $libelles 
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
