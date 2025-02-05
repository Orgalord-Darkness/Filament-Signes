<?php

namespace App\Traits;

use App\Models\Secteur;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

trait FieldsSignalement
{
    /**
     * Fields Form
     *
     * @return void
     */
    protected function addFields() {

        if (!backpack_user()->hasRole('Opérateur')) {
            CRUD::addField([
                'name'  => 'date',
                'type'  => 'datetime_picker',
                'label' => 'Date et heure du signalement',
                'datetime_picker_options' => ['language' => 'fr'],
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
                'tab' => __('messages.signal.tab1')
            ]);
        }
        else {
            CRUD::addField([
                'name'  => 'date',
                'type' => 'hidden',
                'value' => date('Y-m-d H:i:s'),
                'tab' => __('messages.signal.tab1')
            ]);
        }

        CRUD::addField([
                'name'  => 'date_evenement',
                'type'  => 'datetime_picker',
                'label' => 'Date et heure de l\'évènement - <small>Si cette date n\'est pas connue, merci de saisir la date et heure du signalement</small>',
                'datetime_picker_options' => ['language' => 'fr'],
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
                'tab' => __('messages.signal.tab1')
        ]);

        // --------------------------------------- Champ Public --------------------------------------
        if (backpack_user()->hasRole('Opérateur')) {

            //Affectation automatique sur Enfance, PA et PH
            $secteurOperateur = backpack_user()->secteur;

            if ($secteurOperateur->code == 'ENF') {
                CRUD::addField([
                    'name' => 'public',
                    'type' => 'radio',
                    'inline' => true,
                    'label' => 'Public',
                    'options' => ['Enfant' => 'Enfant', 'PA' => 'PA', 'PH' => 'PH'],
                    'value' => 'Enfant',
                    'wrapperAttributes' => ['class' => 'form-group col-md-3'],
                    'tab' => __('messages.signal.tab1')
                ]);
            } elseif ($secteurOperateur->code == 'PA') { 
                CRUD::addField([
                    'name' => 'public',
                    'type' => 'radio',
                    'inline' => true,
                    'label' => 'Public',
                    'options' => ['Enfant' => 'Enfant', 'PA' => 'PA', 'PH' => 'PH'],
                    'value' => 'PA',
                    'wrapperAttributes' => ['class' => 'form-group col-md-3'],
                    'tab' => __('messages.signal.tab1')
                ]);
            } elseif ($secteurOperateur->code == 'PH') { 
                CRUD::addField([
                    'name' => 'public',
                    'type' => 'radio',
                    'inline' => true,
                    'label' => 'Public',
                    'options' => ['Enfant' => 'Enfant', 'PA' => 'PA', 'PH' => 'PH'],
                    'value' => 'PH',
                    'wrapperAttributes' => ['class' => 'form-group col-md-3'],
                    'tab' => __('messages.signal.tab1')
                ]);
            } else {
                CRUD::addField([
                    'name' => 'public',
                    'type' => 'radio',
                    'inline' => true,
                    'label' => 'Public',
                    'options' => ['Enfant' => 'Enfant', 'PA' => 'PA', 'PH' => 'PH'],
                    'wrapperAttributes' => ['class' => 'form-group col-md-3'],
                    'tab' => __('messages.signal.tab1')
                ]);
            }
        } else {
            CRUD::addField([
                'name' => 'public',
                'type' => 'radio',
                'inline' => true,
                'label' => 'Public',
                'options' => ['Enfant' => 'Enfant', 'PA' => 'PA', 'PH' => 'PH'],
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
                'tab' => __('messages.signal.tab1')
            ]);
        }
        // --------------------------------------- Etablissement et Déclarant --------------------------------------
        CRUD::addFields([
            [   // Fieldset
                'name' => 'etab',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Etablissement / Service</legend></fieldset>',
                'tab' => __('messages.signal.tab1')
            ],
            [
                'name' => 'secteur_id',
                'type' => 'select',
                'entity' => 'secteur',
                'attribute' => 'libelle',
                'label' => 'Secteur',
                'placeholder' => 'Sélectionner un Secteur',
                'allows_null' => true,
                'default' => backpack_user()->secteur_id,
                'options' => (function ($query) {
                    if (backpack_user()->hasRole('Opérateur')) {
                        return $query->where('id', backpack_user()->secteur_id)->get();
                    }
                    //Sinon tous secteurs
                    else {
                        return Secteur::all();
                    }
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
                'tab' => __('messages.signal.tab1')
            ]
        ]);
        if (backpack_user()->hasRole('Opérateur')) {
            CRUD::addField([
                'name' => 'etablissement_id',
                'type' => 'select',
                'entity' => 'etablissement',
                'attribute' => 'nom',
                'label' => 'Etablissement / Service',
                'placeholder' => 'Sélectionner un Etablissement / Service',
                'allows_null' => true,
                'default' => backpack_user()->etablissement_id,
                'options' => (function ($query) {
                    //Etabs de l'opérateur
                    return $query->whereIn('id', backpack_user()->etablissements->pluck('id'))->get();
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-9'],
                'tab' => __('messages.signal.tab1')
            ]);
        } else {
            CRUD::addField([
                'name' => 'etablissement_id',
                'type' => 'select2_from_ajax',
                'entity' => 'etablissement',
                'attribute' => 'nom',
                'label' => 'Etablissement / Service',
                'data_source'  => url('api/etablissement'),
                'placeholder' => 'Sélectionner un Etablissement / Service',
                'include_all_form_fields' => true,
                'minimum_input_length' => 0,
                'wrapperAttributes' => ['class' => 'form-group col-md-9'],
                'tab' => __('messages.signal.tab1')
            ]);
        }
        CRUD::addFields([
            [   // Fieldset
                'name' => 'declarant',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Déclarant</legend></fieldset>',
                'tab' => __('messages.signal.tab1')
            ],
            [
                'name' => 'civilite',
                'type' => 'radio',
                'inline' => true,
                'label' => 'Civilité',
                'options' => ['M.' => 'M.', 'Mme' => 'Mme'],
                'default' => backpack_user()->civilite,
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
                'tab' => __('messages.signal.tab1')
            ],
            [
                'name' => 'prenom',
                'type' => 'text',
                'label' => 'Prénom',
                'default' => backpack_user()->prenom,
                'wrapperAttributes' => ['class' => 'form-group col-md-5'],
                'tab' => __('messages.signal.tab1')
            ],
            [
                'name' => 'nom',
                'type' => 'text',
                'default' => backpack_user()->nom,
                'wrapperAttributes' => ['class' => 'form-group col-md-5'],
                'tab' => __('messages.signal.tab1')
            ],
            [
                'name'   => 'fonction_id',
                'type'   => 'relationship',
                'entity' => 'fonction',
                'attribute' => 'libelle',
                'label' => 'Fonction',
                'allows_null' => true,
                'placeholder' => 'Sélectionner une fonction',
                'options' => (function ($query) {
                    //Sélection des rubriques Fonction
                    return $query->where('rubrique_id', 27)->orderBy('ordre','ASC')->get();
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab1')
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Courriel',
                'default' => backpack_user()->email,
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab1')
            ],
            [
                'name' => 'tel',
                'type' => 'text',
                'label' => 'Téléphone',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab1')
            ],
            [   // Fieldset
                'name' => 'autorites',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Autorités administratives informées</legend></fieldset>',
                'tab' => __('messages.signal.tab1')
            ],
            ['name' => 'ars_info', 'type' => 'checkbox', 'label' => 'ARS - Agence Régionale de Santé', 'tab' => __('messages.signal.tab1')],
            ['name' => 'ddpp_info', 'type' => 'checkbox', 'label' => 'DDPP - Direction Départementale de la Protection des Populations', 'tab' => __('messages.signal.tab1')],
            ['name' => 'dtpjj_info', 'type' => 'checkbox', 'label' => 'DTPJJ - Direction Territoriale de la Protection Judiciaire de la Jeunesse du Val d\'Oise', 'tab' => __('messages.signal.tab1')],
            ['name' => 'prefet_info', 'type' => 'checkbox', 'label' => 'Préfet', 'tab' => __('messages.signal.tab1')],
            
            // --------------------------------------- Faits et Victimes --------------------------------------
            [   // Nature des Faits
                'name' => 'nature_faits',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Nature des faits</legend>'.__('messages.signal.nature_faits').'</fieldset>',
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'   => 'rub_nature1_id',
                'type'   => 'relationship',
                'entity' => 'rub_nature1',
                'attribute' => 'libelle',
                'label' => 'Catégorie Nature des Faits principale',
                'allows_null' => true,
                'placeholder' => 'Sélectionner une catégorie',
                'options' => (function ($query) {
                    //Sélection des rubriques de la section Nature des Faits
                    return $query->where('section_id', 1)->orderBy('ordre','ASC')->get();
                }),
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'         => 'nature1_id',
                'type'         => 'select2_from_ajax',
                'entity'       => 'nature1',
                'attribute'    => 'libelle',
                'label'        => 'Nature des Faits principale',
                'data_source'  => url('api/rubnature1'),
                'placeholder'  => 'Sélectionner une nature',
                'include_all_form_fields' => true,
                'minimum_input_length' => 0,
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'  => 'nature1_autre',
                'label' => 'Si Autre, précisez',
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'   => 'rub_nature2_id',
                'type'   => 'relationship',
                'entity' => 'rub_nature2',
                'attribute' => 'libelle',
                'label' => 'Catégorie Nature des Faits secondaire',
                'allows_null' => true,
                'placeholder' => 'Sélectionner une catégorie',
                'options' => (function ($query) {
                    //Sélection des rubriques de la section Nature des Faits
                    return $query->where('section_id', 1)->orderBy('ordre','ASC')->get();
                }),
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'         => 'nature2_id',
                'type'         => 'select2_from_ajax',
                'entity'       => 'nature2',
                'attribute'    => 'libelle',
                'label'        => 'Nature des Faits secondaire',
                'data_source'  => url('api/rubnature2'),
                'placeholder'  => 'Sélectionner une nature',
                'include_all_form_fields' => true,
                'minimum_input_length' => 0,
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'  => 'nature2_autre',
                'label' => 'Si Autre, précisez',
                'tab' => __('messages.signal.tab2')
            ],
            [   // Circonstances
                'name' => 'circonstances',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Description des circonstances et déroulement des faits</legend>'.__('messages.signal.description_faits').'</fieldset>',
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name' => 'description',
                'type' => 'textarea',
                'label' => __('messages.signal.confidentiel'),
                'attributes' => [
                    'rows' => 8,
                ],
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name' => 'eig',
                'type' => 'radio',
                'inline' => true,
                'label' => 'L\'EIG s\'est passé pendant une période tendue de l\'organisation',
                'options' => ['Oui' => 'Oui', 'Non' => 'Non'],
                'wrapperAttributes' => ['class' => 'form-group col-md-5'],
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name' => 'periode_eig',
                'type' => 'select_from_array',
                'allows_null' => true,
                'options' => [
                    'Durant la nuit' => 'Durant la nuit',
                    'Durant le week-end' => 'Durant le week-end',
                    'Un jour férié' => 'Un jour férié',
                    'Heure de changement d\'équipe' => 'Heure de changement d\'équipe',
                    'Autre' => 'Autre'
                ],
                'label' => 'Période EIG',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'  => 'periode_eig_autre',
                'type'  => 'text',
                'label' => 'Si Autre, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab2')
            ],
            [   // Victimes
                'name' => 'victimes',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Victimes et personnes exposées</legend>',
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'  => 'victimes_pec',
                'type'  => 'radio',
                'inline' => true,
                'options' => [
                    'Aucune' => 'Aucune',
                    'Une' => 'Une',
                    'Deux' => 'Deux',
                    'Trois' => 'Trois',
                    'Quatre' => 'Quatre',
                    'Cinq et plus' => 'Cinq et plus',
                    'Tous' => 'Tous',
                ],
                'label' => 'Nombre de victimes prises en charge',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'  => 'perex_pec',
                'type'  => 'radio',
                'inline' => true,
                'options' => [
                    'Aucune' => 'Aucune',
                    'Une' => 'Une',
                    'Deux' => 'Deux',
                    'Trois' => 'Trois',
                    'Quatre' => 'Quatre',
                    'Cinq et plus' => 'Cinq et plus',
                    'Tous' => 'Tous',
                ],
                'label' => 'Nombre de personnes prises en charge exposées',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'  => 'victimes_pro',
                'type'  => 'radio',
                'inline' => true,
                'options' => [
                    'Aucune' => 'Aucune',
                    'Une' => 'Une',
                    'Deux' => 'Deux',
                    'Trois' => 'Trois',
                    'Quatre' => 'Quatre',
                    'Cinq et plus' => 'Cinq et plus',
                    'Tous' => 'Tous',
                ],
                'label' => 'Nombre de victimes professionnels',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'  => 'perex_pro',
                'type'  => 'radio',
                'inline' => true,
                'options' => [
                    'Aucune' => 'Aucune',
                    'Une' => 'Une',
                    'Deux' => 'Deux',
                    'Trois' => 'Trois',
                    'Quatre' => 'Quatre',
                    'Cinq et plus' => 'Cinq et plus',
                    'Tous' => 'Tous',
                ],
                'label' => 'Nombre de professionnels exposés',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'  => 'victimes_autre',
                'type'  => 'radio',
                'inline' => true,
                'options' => [
                    'Aucune' => 'Aucune',
                    'Une' => 'Une',
                    'Deux' => 'Deux',
                    'Trois' => 'Trois',
                    'Quatre' => 'Quatre',
                    'Cinq et plus' => 'Cinq et plus',
                    'Tous' => 'Tous',
                ],
                'label' => 'Nombre de victimes autre',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab2')
            ],
            [
                'name'  => 'perex_autre',
                'type'  => 'radio',
                'inline' => true,
                'options' => [
                    'Aucune' => 'Aucune',
                    'Une' => 'Une',
                    'Deux' => 'Deux',
                    'Trois' => 'Trois',
                    'Quatre' => 'Quatre',
                    'Cinq et plus' => 'Cinq et plus',
                    'Tous' => 'Tous',
                ],
                'label' => 'Nombre de personnes exposées autre',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab2')
            ],

            // --------------------------------------- Conséquences, Secours et Mesures --------------------------------------
            [   // Conséquences
                'name' => 'consequences',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Conséquences constatées au moment de la transmission d\'information</legend>',
                'tab'   => __('messages.signal.tab3')
            ],
            [
                'name'      => 'consequences1',
                'type'      => 'select2_multiple',
                'label'     => 'Pour la ou les personnes prises en charge',
                'entity'    => 'consequences1',
                'model'     => 'App\Models\Option',
                'attribute' => 'libelle',
                'pivot'     => true,
                'options'   => (function ($query) {
                    //Sélection des options de la section Dispositions
                    return $query->where('rubrique_id', 12)->orderBy('ordre','ASC')->get();
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-7'],
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name'  => 'consequence1_autre',
                'type'  => 'text',
                'label' => 'Si Autre, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-5'],
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name'      => 'consequences2',
                'type'      => 'select2_multiple',
                'label'     => 'Pour les professionnels',
                'entity'    => 'consequences2',
                'model'     => 'App\Models\Option',
                'attribute' => 'libelle',
                'pivot'     => true,
                'options'   => (function ($query) {
                    //Sélection des options de la section Dispositions
                    return $query->where('rubrique_id', 13)->orderBy('ordre','ASC')->get();
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-7'],
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name'  => 'consequence2_autre',
                'type'  => 'text',
                'label' => 'Si Autre, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-5'],
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name'      => 'consequences3',
                'type'      => 'select2_multiple',
                'label'     => 'Pour l\'organisation et le fonctionnement de l\'établissement',
                'entity'    => 'consequences3',
                'model'     => 'App\Models\Option',
                'attribute' => 'libelle',
                'pivot'     => true,
                'options'   => (function ($query) {
                    //Sélection des options de la section Dispositions
                    return $query->where('rubrique_id', 14)->orderBy('ordre','ASC')->get();
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-7'],
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name'  => 'consequence3_autre',
                'type'  => 'text',
                'label' => 'Si Autre, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-5'],
                'tab' => __('messages.signal.tab3')
            ],
            [   // Secours
                'name' => 'secours',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Demande d\'intervention des secours</legend>',
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name'   => 'secours_id',
                'type'   => 'relationship',
                'entity' => 'secours',
                'attribute' => 'libelle',
                'label' => 'Demande d\'intervention des secours',
                'allows_null' => true,
                'placeholder' => 'Sélectionner une valeur',
                'options' => (function ($query) {
                    //Sélection des options de la section Secours
                    return $query->where('rubrique_id', 15)->orderBy('ordre','ASC')->get();
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name'  => 'secours_non',
                'type'  => 'text',
                'label' => 'Si Non, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name'  => 'secours_autre',
                'type'  => 'text',
                'label' => 'Si Autre, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab3')
            ],
            ['name' => 'secours_ide', 'type' => 'checkbox', 'label' => 'IDE (Infirmière Diplômée d\'Etat)', 'tab' => __('messages.signal.tab3')],
            ['name' => 'secours_medecin', 'type' => 'checkbox', 'label' => 'Médecin', 'tab' => __('messages.signal.tab3')],
            ['name' => 'secours_medecin2', 'type' => 'checkbox', 'label' => 'Médecin traitant', 'tab' => __('messages.signal.tab3')],
            ['name' => 'secours_police', 'type' => 'checkbox', 'label' => 'Police', 'tab' => __('messages.signal.tab3')],
            ['name' => 'secours_samu', 'type' => 'checkbox', 'label' => 'SAMU', 'tab' => __('messages.signal.tab3')],
            ['name' => 'secours_pompiers', 'type' => 'checkbox', 'label' => 'Pompiers', 'tab' => __('messages.signal.tab3')],
            [   // Mesures
                'name' => 'mesures',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Mesures immédiates prises par l\'établissement</legend>',
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name' => 'mesure1',
                'type' => 'textarea',
                'label' => 'Pour protéger, accompagner ou soutenir les victimes ou personnes exposées - '. __('messages.signal.confidentiel'),
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name' => 'mesure2',
                'type' => 'textarea',
                'label' => 'Pour assurer la continuité de la prise en charge - '. __('messages.signal.confidentiel'),
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name' => 'mesure3',
                'type' => 'textarea',
                'label' => 'A l\'égard des autres personnes prise en charge ou du personnel, le cas échéant - '. __('messages.signal.confidentiel'),
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name' => 'mesure3_info',
                'type' => 'checkbox',
                'label' => 'Information à l\'ensemble du personnel',
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name' => 'mesure3_soutien',
                'type' => 'checkbox',
                'label' => 'Soutien psychologique',
                'tab' => __('messages.signal.tab3')
            ],
            [
                'name' => 'mesure3_reunion',
                'type' => 'checkbox',
                'label' => 'Réunion entre la direction et l\'équipe concernée',
                'tab' => __('messages.signal.tab3')
            ],

            // --------------------------------------- Information et Dispositions--------------------------------------
            [   // Information
                'name' => 'infos',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Information aux proches, famille, et personnes concernées</legend>'.__('messages.signal.information').'</legend>',
                'tab' => __('messages.signal.tab4')
            ],
            [
                'name' => 'information',
                'type' => 'radio',
                'inline' => true,
                'label' => 'Information',
                'options' => ['Oui' => 'Oui', 'Non' => 'Non', 'Ne sais pas' => 'Ne sais pas', 'Sans objet' => 'Sans objet'],
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab4')
            ],
            [
                'name'  => 'information_non',
                'type'  => 'text',
                'label' => 'Si Non, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab4')
            ],
            [
                'name'      => 'destinataires',
                'type'      => 'select2_multiple',
                'entity'    => 'destinataires',
                'model'     => 'App\Models\Option',
                'attribute' => 'libelle',
                'pivot'     => true,
                'options' => (function ($query) {
                    //Sélection des options de la section Informations
                    return $query->where('rubrique_id', 16)->orderBy('ordre','ASC')->get();
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab4')
            ],
            [
                'name'  => 'information_autre',
                'type'  => 'text',
                'label' => 'Si Autre destinataire, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab4')
            ],
            [   // Dispositions
                'name' => 'dispositions',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Dispositions prises ou envisagées par l\'établissement</legend>',
                'tab' => __('messages.signal.tab4')
            ],
            [
                'name'      => 'dispositions1',
                'type'      => 'select2_multiple',
                'label'     => 'Concernant les usagers',
                'entity'    => 'dispositions1',
                'model'     => 'App\Models\Option',
                'attribute' => 'libelle',
                'pivot'     => true,
                'options' => (function ($query) {
                    //Sélection des options de la section Dispositions
                    return $query->where('rubrique_id', 17)->orderBy('ordre','ASC')->get();
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                'tab' => __('messages.signal.tab4')
            ],
            [
                'name'  => 'disposition1_autre',
                'type'  => 'text',
                'label' => 'Si Autre, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab4')
            ],
            [
                'name'      => 'dispositions2',
                'type'      => 'select2_multiple',
                'label'     => 'Concernant les professionnels',
                'entity'    => 'dispositions2',
                'model'     => 'App\Models\Option',
                'attribute' => 'libelle',
                'pivot'     => true,
                'options' => (function ($query) {
                    //Sélection des options de la section Dispositions
                    return $query->where('rubrique_id', 18)->orderBy('ordre','ASC')->get();
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                'tab' => __('messages.signal.tab4')
            ],
            [
                'name'  => 'disposition2_autre',
                'type'  => 'text',
                'label' => 'Si Autre, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab4')
            ],
            [
                'name'      => 'dispositions3',
                'type'      => 'select2_multiple',
                'label'     => 'Concernant l\'organisation du travail',
                'entity'    => 'dispositions3',
                'model'     => 'App\Models\Option',
                'attribute' => 'libelle',
                'pivot'     => true,
                'options' => (function ($query) {
                    //Sélection des options de la section Dispositions
                    return $query->where('rubrique_id', 19)->orderBy('ordre','ASC')->get();
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                'tab' => __('messages.signal.tab4')
            ],
            [
                'name'  => 'disposition3_autre',
                'type'  => 'text',
                'label' => 'Si Autre, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab4')
            ],
            [
                'name'      => 'dispositions4',
                'type'      => 'select2_multiple',
                'label'     => 'Concernant l\'établissement',
                'entity'    => 'dispositions4',
                'model'     => 'App\Models\Option',
                'attribute' => 'libelle',
                'pivot'     => true,
                'options' => (function ($query) {
                    //Sélection des options de la section Dispositions
                    return $query->where('rubrique_id', 20)->orderBy('ordre','ASC')->get();
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                'tab' => __('messages.signal.tab4')
            ],
            [
                'name'  => 'disposition4_autre',
                'type'  => 'text',
                'label' => 'Si Autre, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab4')
            ],
            // --------------------------------------- Suites et Répercutions--------------------------------------
            [   // Suites
                'name' => 'suites',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Suites administratives ou judiciaires</legend>',
                'tab' => __('messages.signal.tab5')
            ],
            [
                'name' => 'suite1',
                'type' => 'radio',
                'inline' => true,
                'label' => 'Enquête de Police ou de Gendarmerie',
                'options' => ['Oui' => 'Oui', 'Non' => 'Non'],
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab5')
            ],
            [
                'name' => 'suite2',
                'type' => 'radio',
                'inline' => true,
                'label' => 'Dépôt de plainte',
                'options' => ['Oui' => 'Oui', 'Non' => 'Non'],
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab5')
            ],
            [
                'name' => 'suite3',
                'type' => 'radio',
                'inline' => true,
                'label' => 'Signalement au Procureur de la République',
                'options' => ['Oui' => 'Oui', 'Non' => 'Non'],
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab5')
            ],
            [   // Evolution
                'name' => 'evol',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Evolution prévisible ou difficultés attendues</legend>',
                'tab' => __('messages.signal.tab5')
            ],
            [
                'name' => 'evolution',
                'type' => 'textarea',
                'label' => __('messages.signal.confidentiel'),
                'attributes' => [
                    'rows' => 5,
                ],
                'tab' => __('messages.signal.tab5')
            ],
            [   // Répercutions
                'name' => 'repercutions',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Répercutions médiatiques</legend>',
                'tab' => __('messages.signal.tab5')
            ],
            [
                'name' => 'media1',
                'type' => 'radio',
                'inline' => true,
                'label' => 'L\'évènement peut-il avoir un impact médiatique ?',
                'options' => ['Oui' => 'Oui', 'Non' => 'Non'],
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab5')
            ],
            [
                'name'  => 'media1_oui',
                'type'  => 'text',
                'label' => 'Si oui, dans quelle mesure ?',
                'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                'tab' => __('messages.signal.tab5')
            ],
            [
                'name' => 'media2',
                'type' => 'radio',
                'inline' => true,
                'label' => 'Les médias sont-ils déjà informés de l\'évènement ?',
                'options' => ['Oui' => 'Oui', 'Non' => 'Non'],
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab5')
            ],
            [
                'name'  => 'media2_oui',
                'type'  => 'text',
                'label' => 'Si oui, par quel moyen ?',
                'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                'tab' => __('messages.signal.tab5')
            ],
            [
                'name' => 'media3',
                'type' => 'radio',
                'inline' => true,
                'label' => 'Communication effectuée ou prévue ?',
                'options' => ['Oui' => 'Oui', 'Non' => 'Non'],
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab' => __('messages.signal.tab5')
            ],
            [
                'name'  => 'media3_oui',
                'type'  => 'text',
                'label' => 'Si oui, précisez par qui ? quand ? comment ?',
                'wrapperAttributes' => ['class' => 'form-group col-md-8'],
                'tab' => __('messages.signal.tab5')
            ],
            // --------------------------------------- Suivi --------------------------------------
            [   // Suivi
                'name' => 'suivi',
                'type' => 'custom_html',
                'value' => '<fieldset class="p"><legend class="text-dark w-auto">Suivi de l\'évènement jusqu\'à sa résolution</legend>',
                'tab' => __('messages.signal.tab6')
            ],
            [
                'name' => 'maitrise',
                'type' => 'radio',
                'inline' => true,
                'label' => 'Après sa survenue, pensez-vous que l\'évènement soit maîtrisé ?',
                'options' => ['Oui' => 'Oui', 'Non' => 'Non', 'En cours' => 'En cours'],
                'tab' => __('messages.signal.tab6')
            ],
            [
                'name' => 'analyse',
                'type' => 'radio',
                'inline' => true,
                'label' => 'L\'évènement va t-il être analysé ?',
                'options' => ['Oui' => 'Oui', 'Non' => 'Non'],
                'tab' => __('messages.signal.tab6')
            ],
            [
                'name' => 'analyse_car_event',
                'type' => 'radio',
                'inline' => true,
                'label' => 'Après l\'analyse, comment qualifieriez-vous le caractère de cet évènement ?',
                'options' => ['Inévitable' => 'Inévitable', 'Probablement inévitable' => 'Probablement inévitable', 'Evitable' => 'Evitable', 'Probablement évitable' => 'Probablement évitable'],
                'tab' => __('messages.signal.tab6')
            ],
            [
                'name' => 'analyse_collect',
                'type' => 'radio',
                'inline' => true,
                'label' => 'L\'analyse a-t-elle été réalisée collectivement ?',
                'options' => ['Oui' => 'Oui', 'Non' => 'Non'],
                'tab' => __('messages.signal.tab6')
            ],
            [
                'name'   => 'analyse_groupe_id',
                'type'   => 'relationship',
                'entity' => 'analyse_groupe',
                'attribute' => 'libelle',
                'label' => 'Groupe d\'analyse',
                'allows_null' => true,
                'placeholder' => 'Sélectionner un groupe',
                'options' => (function ($query) {
                    //Sélection des rubriques Groupe analyse
                    return $query->where('rubrique_id', 21)->orderBy('ordre','ASC')->get();
                }),
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab6')
            ],
            [
                'name'  => 'analyse_groupe_autre',
                'type'  => 'text',
                'label' => 'Si Autre, précisez',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab' => __('messages.signal.tab6')
            ],
            [
                'name' => 'commentaire',
                'type' => 'textarea',
                'label' => 'Commentaire - '. __('messages.signal.confidentiel'),
                'attributes' => [
                    'rows' => 5,
                ],
                'tab' => __('messages.signal.tab6')
            ],
        ]);
    }
}
