<?php

namespace App\Models;

use App\Scopes\OrderScope;
use Spatie\Permission\Traits\HasRoles;
use App\Scopes\IncludeAllScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catfaq extends ActiveBaseModel
{
    use HasRoles; 
    use SoftDeletes ; 

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
        //static::addGlobalScope(new IncludeAllScope);
    }
}
