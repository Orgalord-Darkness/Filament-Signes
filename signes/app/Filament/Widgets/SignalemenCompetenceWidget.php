<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Signalement ; 
use App\Models\Etablissement ; 
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class SignalemenCompetenceWidget extends ChartWidget
{
    use InteractsWithPageFilters ; 
    protected static ?string $heading = 'Nombre de signalements par compétences';

    protected function getData(): array
    {
        $etabs = Etablissement::all();

        $annee = $this->filters['annee'] ?? null;
        $directionId = $this->filters['direction'] ?? null;

        foreach ($etabs as $ligne) {
            $query = Signalement::where('etablissement_id', $ligne->competence);

            if (!empty($annee)) {
                $query = $query->where('created_at', '>=', $annee.'-01-01')->where('created_at', '<',  $annee.'-12-31');
            }
            $datas[] = $query->count();
            $colors[] = 'rgb('.rand(0, 255).','.rand(0, 255).','.rand(0, 255).')';
            $libelles[] = $ligne->competence;
        }
        return 
        [
            'datasets' => [  
                [          
                    'label' =>'Nb Signalements', 
                    'data' => $datas, 
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
