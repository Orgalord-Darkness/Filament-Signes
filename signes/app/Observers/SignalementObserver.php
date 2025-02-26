<?php

namespace App\Observers;

use App\Models\Signalement;

class SignalementObserver
{
    /**
     * Handle the Signalement "created" event.
     */
    public function created(Signalement $signalement): void
    {
        //Valeurs par défaut pour les attributs automatiques 
        if(is_null($signalement->etat)){
            $signalement->etat = "Ouvert" ; 
        }

        if(is_null($signalement->complet)){
            $signalement->complet = true ; 
        }

        if (request()->has('destinataires')) {
            $signalement->destinataires()->sync(request()->input('destinataires'));
        }
    }

    /**
     * Handle the Signalement "updated" event.
     */
    public function updated(Signalement $signalement): void
    {
        //Valeurs par défaut pour les attributs automatiques 
        if(is_null($signalement->etat)){
            $signalement->etat = "Ouvert" ; 
        }

        if(is_null($signalement->complet)){
            $signalement->complet = true ; 
        }
    }

    /**
     * Handle the Signalement "deleted" event.
     */
    public function deleted(Signalement $signalement): void
    {
        //
    }

    /**
     * Handle the Signalement "restored" event.
     */
    public function restored(Signalement $signalement): void
    {
        //
    }

    /**
     * Handle the Signalement "force deleted" event.
     */
    public function forceDeleted(Signalement $signalement): void
    {
        //
    }
}
