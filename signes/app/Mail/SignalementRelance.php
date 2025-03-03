<?php

namespace App\Mail;

use App\Models\Signalement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\Admin\SignalementCrudController;

class SignalementRelance extends Mailable
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
        $subject = $this->signalement->etablissement->nom." - Relance signalement N° ".$this->signalement->id." du ".date('d-m-Y H:i:s', strtotime($this->signalement->date));

        $expediteur = '';
        $destinataire = '';
        $destinataires_cc = array();

        // Destinataire : Courriel du signalement
        if (isset($this->signalement->email)) $destinataire = $this->signalement->email;

        // Destinataires en copie : 1er et 2ème courriel du secteur, responsable secteur, gestionnaire ESSMS        
        if (isset($this->signalement->secteur->email)) {
            $expediteur         = $this->signalement->secteur->email;
            $destinataires_cc[] = $this->signalement->secteur->email;
        }
        if (isset($this->signalement->secteur->email2)) $destinataires_cc[] = $this->signalement->secteur->email2;
        if (isset($this->signalement->secteur->responsable->email)) $destinataires_cc[] = $this->signalement->secteur->responsable->email;
        if (isset($this->signalement->etablissement->gestionnaire->email)) $destinataires_cc[] = $this->signalement->etablissement->gestionnaire->email;
        
        // Ticket 19 - Log Envoi Mail$
                
        return $this
            ->to($destinataire)
            ->cc($destinataires_cc)
            ->from($expediteur)
            ->subject($subject)
            ->markdown('emails.signalement_relance', ['signalement' => $this->signalement]);
    }
}
