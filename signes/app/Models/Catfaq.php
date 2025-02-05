<?php

namespace App\Models;

use App\Scopes\OrderScope;
use Spatie\Permission\Traits\HasRoles;

class Catfaq extends ActiveBaseModel
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
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function clearGlobalScopes()
    {
        static::$globalScopes = [];
    }

    /* Tri par Libellé */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderScope(['libelle']));
    }
}
