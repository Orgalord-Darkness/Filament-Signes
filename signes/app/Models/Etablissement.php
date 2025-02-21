<?php

namespace App\Models;

use App\Scopes\OrderScope;
use Spatie\Permission\Traits\HasRoles;

class Etablissement extends ActiveBaseModel
{
    use HasRoles;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function commune()
	{
		return $this->belongsTo(Commune::class);
    }

    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function gestionnaire()
    {
        return $this->belongsTo(User::class);
    }

    public function signalements()
     {
        return $this->toMany(Signalement::class) ; 
     }

    /*
    |--------------------------------------------------------------------------
    | SETTERS
    |--------------------------------------------------------------------------
    */

    public function setDelosAttribute($delos)
    {
        //Forçage en majuscules
        $this->attributes['delos'] = strtoupper($delos);
        return $this;
    }

    public function setNomAttribute($nom)
    {
        //Forçage en majuscules
        $this->attributes['nom'] = strtoupper($nom);
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function clearGlobalScopes()
    {
        static::$globalScopes = [];
    }

    /* Tri par Nom */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderScope(['nom']));
    }
}
