<?php

namespace App\Traits;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

trait ColumnSignalement
{
    /**
     * List columns
     *
     * @return void
     */
    protected function addColumns()
    {
        $this->crud->query->withCount('actions');

        CRUD::addColumns([
            ['name' => 'id', 'type' => 'text', 'label' => 'N°'],
            ['name' => 'date_evenement', 'type' => 'date', 'label' => 'Date évènement'],
            ['name' => 'secteur_id', 'entity' => 'secteur', 'type' => 'select', 'attribute' => 'libelle'],
            ['name' => 'etablissement_id', 'entity' => 'etablissement', 'type' => 'select', 'limit' => '50', 'attribute' => 'nom'],
            [
                'name' => 'etat',
                'type' => 'text',
                'wrapper' => [
                    'element' => 'span',
                    'class'   => function ($crud, $column, $entry) {
                        if ($entry->etat == 'Ouvert') {
                            return 'badge badge-pill badge-primary';
                        }
                        if ($entry->etat == 'Réceptionné') {
                            return 'badge badge-pill badge-secondary';
                        }
                        elseif ($entry->etat == 'En cours') {
                            return 'badge badge-pill badge-success';
                        }
                        elseif ($entry->etat == 'Relancé') {
                            return 'badge badge-pill badge-warning';
                        }
                        elseif ($entry->etat == 'Fermé') {
                            return 'badge badge-pill badge-dark';
                        }
                    },
                    'style'   => function ($crud, $column, $entry) {
                        return 'font-size:1rem;';
                    },
                ]
            ],
            [
                'name' => 'complet',
                'type' => 'boolean',
                'wrapper' => [
                    'element' => 'span',
                    'class'   => function ($crud, $column, $entry) {
                        if ($entry->complet) {
                            return 'badge badge-pill badge-success';
                        }
                        else {
                            return 'badge badge-pill badge-danger';
                        }
                    },
                    'style'   => function ($crud, $column, $entry) {
                        return 'font-size:1rem;';
                    },
                ]
            ],
        ]);
        //Accès aux actions autorisé aux Admins et Gestionnaires
        if (backpack_user()->hasRole('Administrateur') || backpack_user()->hasRole('Gestionnaire')) {
            CRUD::addColumn([
                'name' => 'actions_count',
                'label' => 'Instruction',
                'type' => 'text',
                'suffix' => ' action.s',
                'visibleInExport' => false,
                'wrapper'   => [
                    'element' => function ($crud, $column, $entry) {
                        //Pas d'affichage du lien si signalement incomplet
                        if (!$entry->complet) {
                            return 'span';
                        }
                    },
                    'href' => function ($crud, $column, $entry) {
                        return backpack_url('action-signal?signalement='.$entry->id);
                    },
                ]
            ]);
        }
        CRUD::addColumns([
            ['name' => 'public', 'type' => 'text'],
            ['name' => 'territoire', 'type' => 'text'],
            ['name' => 'date_evenement', 'type' => 'date', 'label' => 'Date évènement'],
            ['name' => 'declarant', 'type' => 'text', 'label' => 'Déclarant.e'],
            ['name' => 'fonction_id', 'entity' => 'fonction', 'type' => 'select', 'attribute' => 'libelle', 'label' => 'Fonction'],
            ['name' => 'email', 'type' => 'text', 'label' => 'Courriel'],
            ['name' => 'tel', 'type' => 'text', 'label' => 'Téléphone'],
            ['name' => 'ars_info', 'type' => 'boolean', 'label' => 'ARS'],
            ['name' => 'ddpp_info', 'type' => 'boolean', 'label' => 'DDPP'],
            ['name' => 'dtpjj_info', 'type' => 'boolean', 'label' => 'DTPJJ'],
            ['name' => 'prefet_info', 'type' => 'boolean', 'label' => 'Préfet'],
            ['name' => 'rub_nature1_id', 'entity' => 'rub_nature1', 'type' => 'select', 'attribute' => 'libelle', 'label' => 'Cat. Nature des faits 1'],
            ['name' => 'nature1_id', 'entity' => 'nature1', 'type' => 'select', 'attribute' => 'libelle', 'label' => 'Nature des faits 1'],
            ['name' => 'rub_nature2_id', 'entity' => 'rub_nature2', 'type' => 'select', 'attribute' => 'libelle', 'label' => 'Cat. Nature des faits 2'],
            ['name' => 'nature2_id', 'entity' => 'nature2', 'type' => 'select', 'attribute' => 'libelle', 'label' => 'Nature des faits 2'],
            ['name' => 'description', 'type' => 'text'],
            ['name' => 'eig', 'type' => 'text', 'label' => 'EIG'],
            ['name' => 'periode_eig', 'type' => 'text', 'label' => 'Période EIG'],
            ['name' => 'victimes_pec', 'type' => 'text', 'label' => 'Victimes PEC'],
            ['name' => 'victimes_pro', 'type' => 'text', 'label' => 'Victimes PRO'],
            ['name' => 'victimes_autre', 'type' => 'text', 'label' => 'Victimes Autre'],
            ['name' => 'perex_pec', 'type' => 'text', 'label' => 'Pers. exp. PEC'],
            ['name' => 'perex_pro', 'type' => 'text', 'label' => 'Pers. exp. PRO'],
            ['name' => 'perex_autre', 'type' => 'text', 'label' => 'Pers. exp. Autre'],
            ['name' => 'consequences1', 'entity' => 'consequences1', 'type' => 'select_multiple', 'attribute' => 'libelle', 'label' => 'Conséq. Résident', 'limit' => 100],
            ['name' => 'consequences2', 'entity' => 'consequences2', 'type' => 'select_multiple', 'attribute' => 'libelle', 'label' => 'Conséq. Pro', 'limit' => 100],
            ['name' => 'consequences3', 'entity' => 'consequences3', 'type' => 'select_multiple', 'attribute' => 'libelle', 'label' => 'Conséq. Etab', 'limit' => 100],
            ['name' => 'secours_id', 'entity' => 'secours', 'type' => 'select', 'attribute' => 'libelle', 'label' => 'Secours'],
            ['name' => 'secours_ide', 'type' => 'boolean', 'label' => 'IDE'],
            ['name' => 'secours_medecin', 'type' => 'boolean', 'label' => 'Médecin'],
            ['name' => 'secours_medecin2', 'type' => 'boolean', 'label' => 'Médecin 2'],
            ['name' => 'secours_police', 'type' => 'boolean', 'label' => 'Police'],
            ['name' => 'secours_samu', 'type' => 'boolean', 'label' => 'SAMU'],
            ['name' => 'secours_pompiers', 'type' => 'boolean', 'label' => 'Pompiers'],
            ['name' => 'mesure1', 'type' => 'text', 'label' => 'Mesure 1'],
            ['name' => 'mesure2', 'type' => 'text', 'label' => 'Mesure 2'],
            ['name' => 'mesure3', 'type' => 'text', 'label' => 'Mesure 3'],
            ['name' => 'mesure_info', 'type' => 'boolean', 'label' => 'Info'],
            ['name' => 'mesure_soutien', 'type' => 'boolean', 'label' => 'Soutien'],
            ['name' => 'mesure_reunion', 'type' => 'boolean', 'label' => 'Réunion'],
            ['name' => 'information', 'type' => 'text'],
            ['name' => 'destinataires', 'entity' => 'destinataires', 'type' => 'select_multiple', 'attribute' => 'libelle', 'limit' => 100],
            ['name' => 'dispositions1', 'entity' => 'dispositions1', 'type' => 'select_multiple', 'attribute' => 'libelle', 'label' => 'Dispositions Usagers', 'limit' => 100],
            ['name' => 'dispositions2', 'entity' => 'dispositions2', 'type' => 'select_multiple', 'attribute' => 'libelle', 'label' => 'Dispositions Pro', 'limit' => 100],
            ['name' => 'dispositions3', 'entity' => 'dispositions3', 'type' => 'select_multiple', 'attribute' => 'libelle', 'label' => 'Dispositions Travail', 'limit' => 100],
            ['name' => 'dispositions4', 'entity' => 'dispositions4', 'type' => 'select_multiple', 'attribute' => 'libelle', 'label' => 'Dispositions Etab.', 'limit' => 100],
            ['name' => 'suite1', 'type' => 'text', 'label' => 'Enquête'],
            ['name' => 'suite2', 'type' => 'text', 'label' => 'Plainte'],
            ['name' => 'suite3', 'type' => 'text', 'label' => 'Signalement'],
            ['name' => 'evolution', 'type' => 'text'],
            ['name' => 'media1', 'type' => 'text'],
            ['name' => 'media2', 'type' => 'text'],
            ['name' => 'media3', 'type' => 'text'],
            ['name' => 'maitrise', 'type' => 'text'],
            ['name' => 'analyse', 'type' => 'text'],
            ['name' => 'analyse_car_event', 'type' => 'text', 'label' => 'Car. évent'],
            ['name' => 'analyse_collect', 'type' => 'text', 'label' => 'Collectif'],
            ['name' => 'analyse_groupe_id', 'entity' => 'analyse_groupe', 'type' => 'select', 'attribute' => 'libelle', 'label' => 'Gpe analyse'],
            ['name' => 'created_at', 'type' => 'date', 'label' => 'Créé le'],
            ['name' => 'user_id', 'entity' => 'user', 'type' => 'select', 'attribute' => 'fullname', 'label' => 'Par'],
            ['name' => 'updated_at', 'type' => 'date', 'label' => 'Modifié le'],
        ]);

        //Tri de la liste
        CRUD::orderBy('id', 'ASC');
    }
}
