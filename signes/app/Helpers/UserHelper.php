<?php

namespace App\Helpers;

class UserHelper
{
    public static function isUtilisateur() : bool
    {
        return auth()->user() && auth()->user()->hasRole('utilisateur');
    }

    public static function isGestionnaire() : bool
    {
        return auth()->user() && auth()->user()->hasRole('gestionnaire');
    }

    public static function isAdmin() : bool
    {
        return auth()->user() && auth()->user()->hasRole('administrateur');
    }

    public static function isSuperAdmin() : bool
    {
        return auth()->user() && auth()->user()->hasRole('super administrateur');
    }
}
