<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Secteur;

class SecteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            ['AF', 'Accueil Familial', 'doms-secretariat@valdoise.fr', 162, 1],
            ['DOM', 'Domicile', 'doms-secretariat@valdoise.fr', 4, 4],
            ['ENF', 'Enfance', 'incidents.enfance@valdoise.fr', 160, 3],
            ['PA', 'Personnes Agées', 'doms-secretariat@valdoise.fr', 4, 2],
            ['PH', 'Personnes Handicapées', 'doms-secretariat@valdoise.fr', 162, 1]
        ];

        foreach ($rows as $row) {
            $sect = Secteur::firstOrNew(['code' => $row[0]]);
            $sect->libelle = $row[1];
            $sect->email = $row[2];
            $sect->responsable_id = $row[3];
            $sect->delai_relance = $row[4];
            $sect->save();
        }
    }
}
