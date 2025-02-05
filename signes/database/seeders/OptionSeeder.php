<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionSeeder extends Seeder
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
            ['Canicule', 1, 1, 1],
            ['Départ de feu', 1, 1, 2],
            ['Incendie', 1, 1, 3],
            ['Inondation', 1, 1, 4],
            ['Tempête', 1, 1, 5],
            ['Rupture d\'accès à l\'établissement/domicile', 1, 1, 6],
            ['Autre', 1, 1, 7],
            ['Défaillance de la qualité de l\'eau', 1, 2, 1],
            ['Epidémie', 1, 2, 2],
            ['Intoxication', 1, 2, 3],
            ['Fuite de Gaz', 1, 2, 4],
            ['Légionnelles', 1, 2, 5],
            ['Panne ascenseur', 1, 2, 6],
            ['Panne chauffage/climatisation', 1, 2, 7],
            ['Panne prolongée électricité', 1, 2, 8],
            ['Rupture eau', 1, 2, 9],
            ['Rupture électricité', 1, 2, 10],
            ['Maladies infectieuses', 1, 2, 11],
            ['Autre', 1, 2, 12],
            ['Absence imprévue de plusieurs professionnels', 1, 3, 1],
            ['Conflits/menace de conflits sociaux', 1, 3, 2],
            ['Préavis de grève', 1, 3, 3],
            ['Difficulté de recrutement', 1, 3, 4],
            ['Insuffisance de personnel', 1, 3, 5],
            ['Vacance de poste prolongée (encadrement)', 1, 3, 6],
            ['Sanction disciplinaire et/ou procédures judiciaires envers un professionnel', 1, 3, 7],
            ['Turn over important', 1, 3, 8],
            ['Autre', 1, 3, 9],
            ['Absence, erreur ou retard de prise en charge ou de traitement', 1, 4, 1],
            ['Accidents corporels (chutes & fractures)', 1, 4, 2],
            ['Déshydratation', 1, 4, 3],
            ['Dénutrition', 1, 4, 4],
            ['Erreur administration du médicament', 1, 4, 5],
            ['Escarres', 1, 4, 6],
            ['Fausse route', 1, 4, 7],
            ['Non-respect de la prescription médicale', 1, 4, 8],
            ['Traitement inadapté', 1, 4, 9],
            ['Autre', 1, 4, 10],
            ['Activités illicites', 1, 5, 1],
            ['Conflit important ou obstacle à la prise en charge', 1, 5, 2],
            ['Défiance vis-à-vis du personnel', 1, 5, 3],
            ['Demandes inadaptées', 1, 5, 4],
            ['Menaces répétées à l\'encontre des professionnels', 1, 5, 5],
            ['Autre', 1, 5, 6],
            ['Décès ', 1, 6, 1],
            ['Décès accidentel', 1, 6, 2],
            ['Décès au cours d\'une disparition inquiétante', 1, 6, 3],
            ['Décès suite à une chute', 1, 6, 4],
            ['Décès suite à un accident de contention', 1, 6, 5],
            ['Autre', 1, 6, 6],
            ['Décès usager par suicide', 1, 7, 1],
            ['Décès professionnel par suicide ', 1, 7, 2],
            ['Tentative de suicide usager', 1, 7, 3],
            ['Tentative de suicide professionnel', 1, 7, 4],
            ['Comportement d\'emprise', 1, 8, 1],
            ['Défaut d\'adaptation des équipements aux personnes à mobilité réduite', 1, 8, 2],
            ['Isolement vis à vis des proches', 1, 8, 3],
            ['Négligence grave et/ou erreurs successives', 1, 8, 4],
            ['Privation de droit', 1, 8, 5],
            ['Violence à caractère sexuel (agression, attouchements, viol)', 1, 8, 6],
            ['Violence verbale (menaces, insultes)', 1, 8, 7],
            ['Violence physique (altercation, coups & blessures)', 1, 8, 8],
            ['Violence psychologique/morale (intimidation, privation, harcèlement)', 1, 8, 9],
            ['Vols', 1, 8, 10],
            ['Autre', 1, 8, 11],
            ['Disparition et retour sans mobilisation des services de recherche ', 1, 9, 1],
            ['Disparition avec intervention des services de recherche ', 1, 9, 2],
            ['Non-respect des règles de vie en collectivité', 1, 10, 1],
            ['Pratiques ou comportements inadaptés ou délictueux', 1, 10, 2],
            ['Violence à caractère sexuel (agression, attouchements, viol)', 1, 10, 3],
            ['Violence physique (altercation, coups & blessures)', 1, 10, 4],
            ['Violence psychologique/morale (intimidation, privation)', 1, 10, 5],
            ['Violence verbale (menaces, insultes)', 1, 10, 6],
            ['Autre', 1, 10, 7],
            ['Détériorations volontaires (locaux, équipements, matériel)', 1, 11, 1],
            ['Vols', 1, 11, 2],
            ['Autre', 1, 11, 3],

            //Conséquences
            ['Aucune', 2, 12, 1],
            ['Aggravation de l\'état de santé', 2, 12, 2],
            ['Blessure', 2, 12, 3],
            ['Changement de comportement ou d\'humeur', 2, 12, 4],
            ['Décès', 2, 12, 5],
            ['Hospitalisation', 2, 12, 6],
            ['Soin en interne', 2, 12, 7],
            ['Autre', 2, 12, 8],

            ['Aucune', 2, 13, 1],
            ['Arrêt maladie', 2, 13, 2],
            ['Décès', 2, 13, 3],
            ['Impossibilité de se rendre sur le lieu du travail', 2, 13, 4],
            ['Organisation d\'une prise en charge médicale et/ou soutien psychologique', 2, 13, 5],
            ['Autre', 2, 13, 6],

            ['Aucune', 2, 14, 1],
            ['Difficultés d\'approvisionnement', 2, 14, 2],
            ['Difficultés d\'accès à l\'établissement ou au lieu de prise en charge', 2, 14, 3],
            ['Nécessité d\'évacuation des résidents', 2, 14, 4],
            ['Suspension d\'activités', 2, 14, 5],
            ['Fonctionnement en mode dégradé', 2, 14, 6],
            ['Autre', 2, 14, 7],

            //Secours
            ['Oui', 3, 15, 1],
            ['Non', 3, 15, 2],
            ['Refus de l\'usager', 3, 15, 3],
            ['Autre', 3, 15, 4],

            //Informations
            ['CVS ou groupes d\'expression', 4, 16, 1],
            ['DAC (Dispositif d\'Appui à la Coordination)', 4, 16, 2],
            ['Famille et proches', 4, 16, 3],
            ['Les Points Conseil (du Département)', 4, 16, 4],
            ['Personne.s concernée.s', 4, 16, 5],
            ['Professionnels', 4, 16, 6],
            ['Personne de confiance', 4, 16, 7],
            ['Responsable légal', 4, 16, 8],
            ['Autre', 4, 16, 9],

            //Dispositions
            ['Aucune', 5, 17, 1],
            ['Adaptation des soins/de la prise en charge', 5, 17, 2],
            ['Fin de prise en charge', 5, 17, 3],
            ['Orientation vers autre établissement/service', 5, 17, 4],
            ['Orientation vers Dispositif Personnes Qualifiées', 5, 17, 5],
            ['Révision du projet de vie', 5, 17, 6],
            ['Soutien psychologique', 5, 17, 7],
            ['Transfert/hospitalisation', 5, 17, 8],
            ['Autre', 5, 17, 9],

            ['Aucune', 5, 18, 1],
            ['Action de formation', 5, 18, 2],
            ['Action de sensibilisation', 5, 18, 3],
            ['Mesure conservatoire', 5, 18, 4],
            ['Mesure disciplinaire', 5, 18, 5],
            ['Soutien psychologique', 5, 18, 6],
            ['Autre', 5, 18, 7],


            ['Aucune', 5, 19, 1],
            ['Fonctionnement en mode dégradé', 5, 19, 2],
            ['Mise en place/à jour de procédures', 5, 19, 3],
            ['Révision de planning', 5, 19, 4],
            ['Autre', 5, 19, 5],

            ['Aucune', 5, 20, 1],
            ['Activation d\'une cellule de crise ou d\'un plan', 5, 20, 2],
            ['Aménagement ou réparation des locaux et/ou équipements', 5, 20, 3],
            ['Demande d\'aide ou d\'appui à l\'autorité administrative', 5, 20, 4],
            ['Information interne et/ou externe', 5, 20, 5],
            ['Autre', 5, 20, 6],

            //Analyse
            ['Direction', 6, 21, 1],
            ['Entre pairs', 6, 21, 2],
            ['Groupe qualité', 6, 21, 3],
            ['Autre', 6, 21, 4],

            //Motif Action
            ['Appel', 7, 22, 1],
            ['Courriel', 7, 22, 2],
            ['Courrier', 7, 22, 3],
            ['Instruction sans suite', 7, 22, 4],
            ['Convocation établissement', 7, 22, 5],
            ['Visite-Contrôle', 7, 22, 6],

            //Réclamations
            //Lien avec la victime
            ['Ami', 8, 23, 1],
            ['Anonyme', 8, 23, 2],
            ['CVS', 8, 23, 3],
            ['Direction', 8, 23, 4],
            ['Famille', 8, 23, 5],
            ['Profession extérieur', 8, 23, 6],
            ['Résident', 8, 23, 7],
            ['Salarié', 8, 23, 8],
            ['Stagiaire', 8, 23, 9],
            ['Tutelle', 8, 23, 10],

            //Mode de contact
            ['3977', 8, 24, 1],
            ['3977 + Autres moyens', 8, 24, 2],
            ['Courrier CD', 8, 24, 3],
            ['Courriel CD', 8, 24, 4],
            ['Courrier ARS', 8, 24, 5],
            ['Courriel ARS', 8, 24, 6],
            ['Courrier CD ARS', 8, 24, 7],
            ['CT CD', 8, 24, 8],

            //Nature des Faits (Suite)
            ['Fugue', 1, 25, 1],
            ['Autre', 1, 26, 1],

            //Fonctions déclarant
            ['Direction', 9, 27, 1],
            ['Paramédical', 9, 27, 2],
            ['Médical', 9, 27, 3],
            ['Educatif', 9, 27, 4],

            //Questions action
            ['Pourriez-vous nous envoyer des éléments complémentaires relatifs à l\'évènement ?', 7, 28, 1],
            ['Pourriez-vous nous faire un retour sur la situation ?', 7, 28, 2],
            ['Pourriez-vous nous transmettre les suites des faits et/ou les éléments complémentaires ?', 7, 28, 3],
            ['Question libre', 7, 28, 4],
        ];

        foreach ($rows as $row) {
            $opt = new Option();
            $opt->libelle = $row[0];
            $opt->section_id = $row[1];
            $opt->rubrique_id = $row[2];
            $opt->ordre = $row[3];
            $opt->actif = 1;
            $opt->save();
        }
    }
}
