<?php

namespace App\Models;

use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
	public $timestamps = false;

    protected $guarded = ['id'];

    /* Tri par Nom */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderScope(['libelle']));
    }

    public static function getAutre()
    {
        $id = null ; 
        $sections = Section::all() ; 
        foreach($sections as $ligne)
        {
            if($ligne['libelle'] === 'Autre')
            {
                $id = $ligne['id'] ; 
            }
        }
        return $id ; 
    }
}
