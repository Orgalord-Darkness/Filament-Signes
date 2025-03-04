<?php

namespace App\Observers;

use App\Models\Signalement;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActionQuestion;
use App\Mail\SignalementOuvert;
use App\Models\ActionSignalement;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Notification;

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

        //Mails
        if($signalement->etat === "Ouvert")
        {
            try {
                Mail::to('test.valdoise@gmail.com')->send(new SignalementOuvert($signalement));
                // Notification::make()
                // ->title('Mail envoyé avec succès !')
                // ->success()
                // ->send();
            } catch (\Exception $e) {
                // Notification::make()
                // ->title('Échec de l\'envoi du mail.')
                // ->danger()
                // ->send();
            }
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

        if($signalement->etat === "Ouvert")
        {
            try {
                Mail::to('test.valdoise@gmail.com')->send(new SignalementOuvert($signalement));
            } catch (\Exception $e) {
                dd($e->getMessage()) ; 
            }
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
