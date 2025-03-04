<?php

namespace App\Models;

use App\Scopes\OrderScope;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\HasName;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\TranslatableResetPasswordNotification;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel ; 
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements FilamentUser, HasName, HasAvatar 
{
    use HasRoles;
    use Notifiable;
    use HasApiTokens; 
    use SoftDeletes ; 

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


    public function getUsernameRoleAttribute()
    {
        if (count($this->roles))
            return $this->username . " (" . $this->roles[0]->name[0] . ")";

        return $this->username;
    }

    public function getFullnameAttribute() : string
    {
        return $this->nom. " " .$this->prenom;
    }

    public function getFilamentName() : string
    {
        return $this->prenom. " " .$this->nom;
    }

    public function getFilamentId(): string
    {
        return $this->id;
    }

    public function getCurrentRoleAttribute() {
        return optional($this->roles->first())->name;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null ;
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

    public function role()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
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

    /*
    |--------------------------------------------------------------------------
    | METHODES
    |--------------------------------------------------------------------------
    */
    public function canAccessPanel(Panel $panel): bool 
    {
        return $this->delete_at == null ? true : false ; 
    }

    public function isAdmin(): bool 
    {
        return $this->role->pluck('name')->contains("Administrateur") ; 
    }

    public function isGestionnaire(): bool 
    {
        return $this->role->pluck('name')->contains("Gestionnaire") ;
    }
}
