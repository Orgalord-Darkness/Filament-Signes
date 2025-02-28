<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\ActionSignalement;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\Admin\ActionSignalementCrudController;

class ActionQuestion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $action ; 
     
    public function __construct(ActionSignalement $action)
    {
        $this->action = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->action->signalement->etablissement->nom." - Question sur le signalement N° ".$this->action->signalement->id." du ".date('d-m-Y H:i:s', strtotime($this->action->signalement->date));

        $expediteur = '';
        $destinataire = '';
        $destinataires_cc = array();

        // Destinataire : Courriel du signalement
        if (isset($this->action->signalement->email)) $destinataire = $this->action->signalement->email;

        // Destinataires en copie : 1er et 2ème courriel du secteur, responsable secteur, gestionnaire ESSMS
        if (isset($this->action->signalement->secteur->email)) {
            $expediteur         = $this->action->signalement->secteur->email;
            $destinataires_cc[] = $this->action->signalement->secteur->email;
        }
        if (isset($this->action->signalement->secteur->email2)) $destinataires_cc[] = $this->action->signalement->secteur->email2;
        if (isset($this->action->signalement->secteur->responsable->email)) $destinataires_cc[] = $this->action->signalement->secteur->responsable->email;
        if (isset($this->action->signalement->etablissement->gestionnaire->email)) $destinataires_cc[] = $this->action->signalement->etablissement->gestionnaire->email;

        return $this
            ->to($destinataire)
            ->cc($destinataires_cc)
            ->from($expediteur)
            ->subject($subject)
            ->markdown('emails.action_question', ['action' => $this->action]);
    }
}
