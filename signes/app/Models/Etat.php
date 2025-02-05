<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'libelle',
    ];
}
