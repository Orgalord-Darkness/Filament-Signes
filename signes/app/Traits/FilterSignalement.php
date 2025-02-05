<?php

namespace App\Traits;

use App\Models\Etat;
use App\Models\User;
use App\Models\Secteur;
use App\Models\Etablissement;
use App\Repositories\TerritoireRepository;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

trait FilterSignalement
{
    /**
     * Create a new controller instance.
     *
     * @param TerritoireRepository $territoireRepository
     *
     * @return void
     */
    public function __construct(TerritoireRepository $territoireRepository)
    {
        $this->territoireRepository = $territoireRepository;
        parent::__construct();
    }

    /**
     * List Filters
     *
     * @return void
     */
    protected function addFilters()
    {
        //Filtre par N°
        CRUD::addFilter(['name' => 'id','type' => 'text', 'label' => 'N°'],
        false,
        function($value) {
            CRUD::addClause('where', 'id', $value);
        });

        //Intervalle Date évènement
        CRUD::addFilter(['type' => 'date_range', 'name' => 'date_evenement', 'label' => 'Evènement entre'],
        false,
        function ($value) {
            $dates = json_decode($value);
            $this->crud->addClause('where', 'date_evenement', '>=', $dates->from);
            $this->crud->addClause('where', 'date_evenement', '<=', $dates->to . ' 23:59:59');
        });

        //Filtre par Etat
        CRUD::addFilter(['type' => 'dropdown', 'name' => 'etat'],
        function() {
            return Etat::orderBy('id','ASC')->pluck('libelle')->toArray();
        },
        function($value) {
            $etat_select = Etat::orderBy('id','ASC')->pluck('libelle')->toArray()[$value];
            CRUD::addClause('where', 'etat', $etat_select);
        });

        //Filtre par Secteur
        CRUD::addFilter(['type' => 'dropdown', 'name' => 'secteur_id', 'label' => 'Secteur'],
        function() {
            return Secteur::all()->pluck('libelle')->toArray();
        },
        function($value) {
            $secteur_select = Secteur::all()->pluck('id')->toArray()[$value];
            CRUD::addClause('where', 'secteur_id', $secteur_select);
        });

        //Filtre par Public
        CRUD::addFilter(['type' => 'dropdown', 'name' => 'public'],
        function() {
            return ['Enfant' => 'Enfant', 'PA' => 'PA', 'PH' => 'PH'];
        },
        function($value) {
            $public_select = ['Enfant' => 'Enfant', 'PA' => 'PA', 'PH' => 'PH'][$value];
            CRUD::addClause('where', 'public', $public_select);
        });

        //Filtre par Territoire
        CRUD::addFilter(['type' => 'dropdown', 'name' => 'territoire'],
        function() {
            return $this->territoireRepository->getTerritoires()->pluck('libelle')->toArray();
        },
        function($value) {
            $territoire_select = $this->territoireRepository->getTerritoires()->pluck('libelle')->toArray()[$value];
            CRUD::addClause('where', 'territoire', $territoire_select);
        });

        //Filtre par Etablissement
        CRUD::addFilter(['type' => 'select2', 'name' => 'etablissement'],
        function() {
            return Etablissement::all()->pluck('nom')->toArray();
        },
        function($value) {
            $etab_select = Etablissement::all()->pluck('id')->toArray()[$value];
            CRUD::addClause('where', 'etablissement_id', $etab_select);
        });

        // Ticket 22
        // Filtre par Utilisateur Gestionnaire 
        CRUD::addFilter([
            'name' => 'gestionnaire_id',
            'type' => 'select2',
            'label' => 'Gestionnaire Etab.',
        ],
        function() {
            $users = User::whereHas('roles', function($query) {
                $query->where('name', 'Gestionnaire');
            })->get();
        
            return $users->pluck('fullname', 'id')->toArray();
        },
        function($value) {
            //Sélection des ESSMS du gestionnaire
            $etabs = Etablissement::where('gestionnaire_id', $value)->pluck('id')->toArray();

            //Sélection des signalements des ESSMS
            CRUD::addClause('whereIn', 'etablissement_id', $etabs);
        });
    }
}
