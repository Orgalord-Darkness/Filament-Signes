<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rubrique;

class RubriqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            //Nature des Faits
            ['1-Sinistre ou événement climatique', 1, 1],
            ['2-Accident/incident lié à défaillance technique et évènement en santé environnementale', 1, 2],
            ['3-Perturbation dans l\'organisation du travail et la gestion des ressources humaines', 1, 3],
            ['4-Accident ou incident lié à une erreur ou un défaut de soin ou de surveillance', 1, 4],
            ['5-Perturbation de l\'organisation ou du fonctionnement liée à des difficultés relationnelles récurrentes avec une famille ou un proche', 1, 5],
            ['6-Décès accidentel ou consécutif à un défaut de surveillance ou de prise en charge d\'une personne', 1, 6],
            ['7-Suicide ou tentative de suicide (usager ou professionnel)', 1, 7],
            ['8-Situation de maltraitance envers les usagers', 1, 8],
            ['9-Disparition inquiétante', 1, 9],
            ['10-Comportement violent au sein de l\'établissement (entre usagers et/ou envers un professionnel) - Manquement grave au règlement de fonctionnement', 1, 10],
            ['11-Actes de malveillance au sein de l\'établissement', 1, 11],

            //Conséquences
            ['Pour la ou les personnes prise(s) en charge', 2, 1],
            ['Pour les professionnels', 2, 2],
            ['Pour l\'organisation et le fonctionnement de l\'établissement', 2, 3],

            //Secours
            ['Demande d\'intervention des secours', 3, 1],

            //Informations
            ['Information aux proches, familles et personnes concernées', 4, 1],

            //Dispositions
            ['Concernant les usagers', 5, 1],
            ['Concernant les professionnels', 5, 2],
            ['Concernant l\'organisation de travail', 5, 3],
            ['Concernant l\'établissement', 5, 4],

            //Analyse
            ['Groupe d\'analyse', 6, 1],

            //Actions
            ['Motif action', 7, 1],

            //Réclamations
            ['Lien avec la victime', 8, 1],
            ['Mode de contact', 8, 2],

            //Nature des Faits - Suite
            ['12-Fugue', 1, 12],
            ['13-Autre', 1, 13],

            //Fonctions déclarant
            ['Fonctions déclarant', 9, 1],

            //Actions
            ['Question action', 7, 2],
        ];

        foreach ($rows as $row) {
            $rub = Rubrique::firstOrNew(['libelle' => $row[0]]);
            $rub->section_id = $row[1];
            $rub->ordre = $row[2];
            $rub->save();
        }
    }
}
