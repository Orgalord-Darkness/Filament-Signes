<?php

namespace App\Models;

use App\Scopes\OrderScope;
use App\Traits\Encryptable;
use App\Models\Etablissement;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignalementOuvert;

class Signalement extends Model
{
    use HasRoles;
    use Encryptable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = ['id'];

    protected $dates = [
        'date',
        'date_evenement',
    ];

    //Données cryptées
    protected $encryptable = [
        'nature1_autre',
        'nature2_autre',
        'description',
        'periode_eig_autre',
        'consequence1_autre',
        'consequence2_autre',
        'consequence3_autre',
        'secours_non',
        'secours_autre',
        'mesure1',
        'mesure2',
        'mesure3',
        'information_non',
        'information_autre',
        'disposition1_autre',
        'disposition2_autre',
        'disposition3_autre',
        'disposition4_autre',
        'evolution',
        'media1_oui',
        'media2_oui',
        'media3_oui',
        'analyse_groupe_autre',
        'commentaire',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function commune()
	{
		return $this->belongsTo(Commune::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function fonction()
    {
        return $this->belongsTo(Option::class);
    }

    public function rub_nature1()
    {
        return $this->belongsTo(Rubrique::class);
    }

    public function nature1()
    {
        return $this->belongsTo(Option::class);
    }

    public function rub_nature2()
    {
        return $this->belongsTo(Rubrique::class);
    }

    public function nature2()
    {
        return $this->belongsTo(Option::class);
    }

    public function consequences1()
    {
        return $this->belongsToMany(Option::class, 'consequence1_signalement', 'signalement_id', 'consequence1_id');
    }

    public function consequences2()
    {
        return $this->belongsToMany(Option::class, 'consequence2_signalement', 'signalement_id', 'consequence2_id');
    }

    public function consequences3()
    {
        return $this->belongsToMany(Option::class, 'consequence3_signalement', 'signalement_id', 'consequence3_id');
    }

    public function secours()
    {
        return $this->belongsTo(Option::class);
    }

    public function analyse_groupe()
    {
        return $this->belongsTo(Option::class);
    }

    public function destinataires()
    {
        return $this->belongsToMany(Option::class, 'destinataire_signalement', 'signalement_id', 'destinataire_id');
    }

    public function dispositions1()
    {
        return $this->belongsToMany(Option::class, 'disposition1_signalement', 'signalement_id', 'disposition1_id');
    }

    public function dispositions2()
    {
        return $this->belongsToMany(Option::class, 'disposition2_signalement', 'signalement_id', 'disposition2_id');
    }

    public function dispositions3()
    {
        return $this->belongsToMany(Option::class, 'disposition3_signalement', 'signalement_id', 'disposition3_id');
    }

    public function dispositions4()
    {
        return $this->belongsToMany(Option::class, 'disposition4_signalement', 'signalement_id', 'disposition4_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | DEPENDANCES
    |--------------------------------------------------------------------------
    */

    public function actions()
    {
        return $this->hasMany(ActionSignalement::class);
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

    public function getEtabidAttribute()
    {
        $etablissement = Etablissement::findOrFail($this->attributes['etablissement_id']);
        return $this->attributes['id']."-".$etablissement->nom;
    }

    public function getDeclarantAttribute()
    {
        return $this->attributes['civilite']." ".$this->attributes['prenom']." ".$this->attributes['nom'];
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

    public function setDateAttribute($value) {
        $this->attributes['date'] = \Carbon\Carbon::parse($value);
    }

    public function setDateEvenementAttribute($value) {
        $this->attributes['date_evenement'] = \Carbon\Carbon::parse($value);
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
        static::addGlobalScope(new OrderScope(['etat']));
    }

    /*
    |------------------------------------------------------------------------
    | BOOTED
    |------------------------------------------------------------------------
    */
    protected static function booted()
    {
        static::created(function () {
            Mail::to('heddy.mameri@valdoise.fr')->send(new SignalementOuvert());
        });
    }
}
