<?php

namespace App\Models;

use App\Scopes\OrderScope;
use App\Traits\Encryptable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class ActionSignalement extends Model
{
    use HasRoles;
    use Encryptable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = ['id'];

    //Données cryptées
    protected $encryptable = [
        'question2',
        'reponse'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function signalement()
    {
        return $this->belongsTo(Signalement::class);
    }

    public function motif()
    {
        return $this->belongsTo(Option::class);
    }

    public function question()
    {
        return $this->belongsTo(Option::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | GETTERS
    |--------------------------------------------------------------------------
    */

    public function getCreatedAtAttribute($value)
    {
        return !empty($value) ? date('d-m-Y H:i:s', strtotime($value)) : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return !empty($value) ? date('d-m-Y H:i:s', strtotime($value)) : null;
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

    /* Tri par Motif */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderScope(['motif_id']));
    }
}
