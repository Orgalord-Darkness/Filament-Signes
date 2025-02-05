<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Etat;

class EtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            'Ouvert',
            'Réceptionné', 
            'En cours', 
            'Relancé',
            'Fermé'
        ];

        foreach ($rows as $row) {
            $etat = Etat::firstOrNew(['libelle' => $row]);
            $etat->save();
        }
    }
}
