<?php

namespace App\Observers;

use App\Models\User ;
use App\Models\Secteur ; 
use App\Models\Signalement;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ActionQuestion;
use App\Mail\SignalementOuvert;
use App\Mail\SignalementFerme;
use App\Models\ActionSignalement;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;


class SignalementObserver
{
    /**
     * Handle the Signalement "created" event.
     */
    public function created(Signalement $signalement): void
    {
        //Valeurs par défaut pour les attributs automatiques 
        $required = [
            'rub_nature1_id', 
            'nature1_id', 
            'description', 
            'eig',
            'periode_eig', 
            'victimes_pec', 
            'victimes_pro',
            'victimes_autre', 
        ] ;
        $incomplet = false ; 
        for($ind = 0 ; $ind < count($required) ; $ind++)
        {
            if(is_null($signalement->{$required[$ind]})){
                $incomplet = true ; 
            }
        }
        if($incomplet === true){
            $signalement->etat = 'null';
            $signalement->complet = false ;  
            $signalement->save() ; 
            
        }else{
            $signalement->etat = 'Ouvert' ; 
            $signalement->complet = true ; 
            $signalement->save() ; 
            Mail::to('test.valdoise@gmail.com')->send(new SignalementOuvert($signalement));
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
        $secteurs = Secteur::all() ; 
        foreach($secteurs as $ligne){
            if($ligne->libelle == "Enfance"){
                $idSecteur = $ligne->id ; 
            }
        }
        $user = null ; 
        $users = User::all() ; 
        foreach($users as $ligne){
            if($ligne->id === Auth::user()->id)
            {
                $user = $ligne ; 
            }
        }

        if($user->isGestionnaire()){
            try {
                $signalement->etat = "Fermé" ;  
                $signalement->save() ; 
                if($signalement->secteur->libelle != "Enfance"){
                    Mail::to('test.valdoise@gmail.com')->send(new SignalementFerme($signalement));
                }
            } catch (\Exception $e) {
                dd($e->getMessage()) ; 
            }
        }

        $required = [
            'rub_nature1_id', 
            'nature1_id', 
            'description', 
            'eig',
            'periode_eig', 
            'victimes_pec', 
            'victimes_pro',
            'victimes_autre',  
        ] ;
        $incomplet = false ;  
        for($ind = 0 ; $ind < count($required) ; $ind++)
        { 
            if (is_null($signalement->{$required[$ind]})) {
                $incomplet = true ; 
                //dd($required[$ind]) ; 
            }else{
                // dd($required[$ind]) ; 
            }
        }
        if($incomplet === false){
            $signalement->etat = "Ouvert" ; 
            $signalement->complet = true ; 
            $signalement->save() ; 
        }

        if($signalement->etat === "Ouvert")
        {
            try {
                Mail::to('test.valdoise@gmail.com')->send(new SignalementOuvert($signalement));
            } catch (\Exception $e) {
                //dd($e->getMessage()) ; 
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
