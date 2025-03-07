<?php

namespace App\Models;

use App\Scopes\OrderScope;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasRoles;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
	public $timestamps = false;

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | GETTERS
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function rubrique()
    {
        return $this->belongsTo(Rubrique::class);
    }

    public function Disposition1Signalement()
    {
        return $this->belongsToMany(Signalement::class, 'disposition1_signalement') ; 
    }

    public function Disposition2Signalement()
    {
        return $this->belongsToMany(Signalement::class, 'disposition1_signalement') ; 
    }

    public function Disposition3Signalement()
    {
        return $this->belongsToMany(Signalement::class, 'disposition1_signalement') ; 
    }

    public function Disposition4Signalement()
    {
        return $this->belongsToMany(Signalement::class, 'disposition1_signalement') ; 
    }

    public function destinataires()
    {
        return $this->belongsToMany(Signalement::class, 'destinataire_signalement'); 
    }

    public function consequence1()
    {
        return $this->belongsToMany(Signalement::class, 'consequence1_signalement'); 
    }

    public function consequence2()
    {
        return $this->belongsToMany(Signalement::class, 'consequence1_signalement'); 
    }

    public function consequence3()
    {
        return $this->belongsToMany(Signalement::class, 'consequence1_signalement'); 
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

    /* Tri par Libellé */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderScope(['libelle']));
    }
}
