<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Signalement ;
use App\Enums\SignalementEtatEnum ; 
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class SignalementEtatWidget extends ChartWidget
{
    protected static ?string $heading = 'Nombre de signalements par état';

    protected function getData(): array
    {
        $etats = array_map(fn (SignalementEtatEnum $etat) => $etat->getLabel(), SignalementEtatEnum::cases());

        $annee = $this->filters['annee'] ?? null;
        $directionId = $this->filters['direction'] ?? null;

        foreach ($etats as $etat) {
            $query = Signalement::where('etat', $etat);

            if (!empty($annee)) {
                $query = $query->where('created_at', '>=', $annee.'-01-01')->where('created_at', '<',  $annee.'-12-31');
            }

            if (!empty($directionId)) {
                $query = $query->where('direction_id', $directionId);
            }
            $datas[] = $query->count();
            $colors[] = 'rgb('.rand(0, 255).','.rand(0, 255).','.rand(0, 255).')';
        }

        return [
            'datasets' => [
                [
                    'label' => 'Nb Signalement',
                    'data'  => $datas,
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
                    'borderColor'     => 'rgb(255, 255, 255)',
                ],
            ],
            'labels' => $etats,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
