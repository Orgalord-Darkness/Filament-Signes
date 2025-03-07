<?php

namespace App\Mail;

use App\Models\Secteur ; 
use App\Models\Signalement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignalementOuvert extends Mailable
{
    use Queueable, SerializesModels;

    public $signalement ; 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Signalement $signalement)
    {
        $this->signalement = $signalement;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->signalement->etablissement->nom." - Ouverture signalement N° ".$this->signalement->id." du ".date('d-m-Y H:i:s', strtotime($this->signalement->date));

        $expediteur = '';
        $destinataire = '';
        $destinataires_cc = array();

        // // Destinataire : Courriel du signalement
        // if (isset($this->signalement->email)) $destinataire = $this->signalement->email;

        // // Destinataires en copie : 1er et 2ème courriel du secteur, responsable secteur, gestionnaire ESSMS        
        // if (isset($this->signalement->secteur->email)) {
        //     $expediteur         = $this->signalement->secteur->email;
        //     $destinataires_cc[] = $this->signalement->secteur->email;
        // }
        // if (isset($this->signalement->secteur->email2)) $destinataires_cc[] = $this->signalement->secteur->email2;
        // if (isset($this->signalement->secteur->responsable->email)) $destinataires_cc[] = $this->signalement->secteur->responsable->email;
        // if (isset($this->signalement->etablissement->gestionnaire->email)) $destinataires_cc[] = $this->signalement->etablissement->gestionnaire->email;
        
        // Ticket 19 - Log Envoi Mail
        $destinataire = 'test.valdoise@gmail.com' ; 
        $expediteur = 'test.valdoise@gmail.com' ; 
        $destinataires_cc = 'test.valdoise@gmail.com' ; 

        if($this->signalement->secteur->libelle == "Enfance" ){
            $vue = 'email.signalements_ouvert_enfance' ; 
        }else{
            $vue = 'email.signalement_ouvert' ; 
        }

        return $this
            ->to($destinataire)
            ->cc($destinataires_cc)
            ->from($expediteur)
            ->subject($subject)
            ->markdown($vue, ['signalement' => $this->signalement]);
    }
}
