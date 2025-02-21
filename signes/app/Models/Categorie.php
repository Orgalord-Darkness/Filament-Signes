<?php

namespace App\Models;

use App\Scopes\OrderScope;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends ActiveBaseModel // Ticket 16
{
    use SoftDeletes ; 

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    public $timestamps = false;

    protected $guarded = ['id'];

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
        static::addGlobalScope(new OrderScope(['libelle']));
    }
}
