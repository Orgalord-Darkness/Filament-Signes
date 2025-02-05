<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            'Nature des Faits',
            'Conséquences',
            'Secours',
            'Informations',
            'Dispositions',
            'Analyse',
            'Action',
            'Réclamation',
            'Fonctions déclarant',
        ];

        foreach ($rows as $row) {
            $section = Section::firstOrNew(['libelle' => $row]);
            $section->save();
        }
    }
}
