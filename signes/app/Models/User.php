<?php

namespace App\Models;

use App\Scopes\OrderScope;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\TranslatableResetPasswordNotification;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = ['id'];

    protected $identifiableAttribute = 'fullname';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | GETTERS
    |--------------------------------------------------------------------------
    */

    public function getFullnameAttribute()
    {
        return $this->prenom." ".$this->nom;
    }

    public function getUsernameRoleAttribute()
    {
        if (count($this->roles))
            return $this->username . " (" . $this->roles[0]->name[0] . ")";

        return $this->username;
    }

    public function getCurrentRoleAttribute() {
        return optional($this->roles->first())->name;
    }

    /*
    |--------------------------------------------------------------------------
    | SETTERS
    |--------------------------------------------------------------------------
    */

    public function setPrenomAttribute($prenom)
    {
        //Forçage en majuscules
        $this->attributes['prenom'] = strtoupper($prenom);
        return $this;
    }

    public function setNomAttribute($nom)
    {
        //Forçage en majuscules
        $this->attributes['nom'] = strtoupper($nom);
        return $this;
    }

    public function setNameAttribute($name)
    {
        //Forçage en majuscules
        $this->attributes['name'] = strtoupper($name);
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

    public function etablissements()
    {
        return $this->belongsToMany(Etablissement::class);
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new TranslatableResetPasswordNotification($token));
    // }

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
