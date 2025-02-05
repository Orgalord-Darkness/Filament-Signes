<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            ['AEMO', 'Action Educative en Milieu Ouvert'],
            ['AJ', 'Accueil de Jour'],
            ['AJTP', 'Accueil de Jour à Temps Partiel'],
            ['CM', 'Centre Maternel'],
            ['CP', 'Centre Parental'],
            ['EHPA', 'Etablissement Hébergement Personnes Agées'],
            ['EHPAD', 'Etablissement Hébergement Personnes Agées Dépendantes'],
            ['FAM', 'Foyer d\'Accueil Médicalisé'],
            ['FH', 'Foyer d\'Hébergement'],
            ['FHE', 'Foyer d\'Hébergement Eclaté'],
            ['FV', 'Foyer de Vie'],
            ['MECS', 'Maison d\'Enfants à Caractère Social'],
            ['MEDIATION', 'Médiation familiale'],
            ['MULTI', 'Etablissements multi agréments'],
            ['PF', 'Placements Familiaux'],
            ['POU', 'Pouponnière'],
            ['PUV', 'Petite Unité de Vie'],
            ['RA', 'Résidence Autonomie'],
            ['REL', 'Relais Parental'],
            ['SAM', 'Service d\'Accueil Modulable'],
            ['SAMSAH', 'Service d\'Accompagnement Médico-Aocial pour Adultes Handicapés'],
            ['SAU', 'Service d\'Accueil d\'Urgence'],
            ['SAVS', 'Service d\'Accompagnement à la Vie Sociale'],
            ['SAVSREG', 'SAVS Regroupé'],
            ['SPEF', 'Service de Protection Enfant Famille'],
            ['SPE MNA', 'Etablissement Spécifique MNA'],
            ['USLD', 'Unité de Soins de Longue Durée'],
            ['AEMO', 'Action Educative en Milieu Ouvert'],
            ['AJ', 'Accueil de Jour'],
            ['AJTP', 'Accueil de Jour à Temps Partiel'],
            ['CM', 'Centre Maternel'],
            ['CP', 'Centre Parental'],
            ['EHPA', 'Etablissement Hébergement Personnes Agées'],
            ['EHPAD', 'Etablissement Hébergement Personnes Agées Dépendantes'],
            ['FAM', 'Foyer d\'Accueil Médicalisé'],
            ['FH', 'Foyer d\'Hébergement'],
            ['FHE', 'Foyer d\'Hébergement Eclaté'],
            ['FV', 'Foyer de Vie'],
            ['MECS', 'Maison d\'Enfants à Caractère Social'],
            ['MEDIATION', 'Médiation familiale'],
            ['MULTI', 'Etablissements multi agréments'],
            ['PF', 'Placements Familiaux'],
            ['POU', 'Pouponnière'],
            ['PUV', 'Petite Unité de Vie'],
            ['RA', 'Résidence Autonomie'],
            ['REL', 'Relais Parental'],
            ['SAM', 'Service d\'Accueil Modulable'],
            ['SAMSAH', 'Service d\'Accompagnement Médico-Aocial pour Adultes Handicapés'],
            ['SAU', 'Service d\'Accueil d\'Urgence'],
            ['SAVS', 'Service d\'Accompagnement à la Vie Sociale'],
            ['SAVSREG', 'SAVS Regroupé'],
            ['SPEF', 'Service de Protection Enfant Famille'],
            ['SPE MNA', 'Etablissement Spécifique MNA'],
            ['USLD', 'Unité de Soins de Longue Durée'],
            ['SAAD', 'Services d\'Aide à Domicile'],
            ['LVA', 'Lieu de Vie et d\'Accueil'],
        ];

        foreach ($rows as $row) {
            $cat = Categorie::firstOrNew(['code' => $row[0]]);
            $cat->libelle = $row[1];
            $cat->actif = true;
            $cat->save();
        }
    }
}
