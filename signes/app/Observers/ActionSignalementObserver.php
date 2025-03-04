<?php

namespace App\Observers;

use App\Models\ActionSignalement;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActionQuestion;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Notification;

class ActionSignalementObserver
{
    /**
     * Handle the ActionSignalement "created" event.
     */
    public function created(ActionSignalement $actionSignalement): void
    {
        //
        try {
            Mail::to('test.valdoise@gmail.com')->send(new ActionQuestion($actionSignalement));
            // Notification::make()
            //     ->title('Mail envoyé avec succès !')
            //     ->success()
            //     ->send();
        } catch (\Exception $e) {
            // Notification::make()
            //     ->title('Échec de l\'envoi du mail.')
            //     ->danger()
            //     ->send();
        }
    }

    /**
     * Handle the ActionSignalement "updated" event.
     */
    public function updated(ActionSignalement $actionSignalement): void
    {
        //
    }

    /**
     * Handle the ActionSignalement "deleted" event.
     */
    public function deleted(ActionSignalement $actionSignalement): void
    {
        //
    }

    /**
     * Handle the ActionSignalement "restored" event.
     */
    public function restored(ActionSignalement $actionSignalement): void
    {
        //
    }

    /**
     * Handle the ActionSignalement "force deleted" event.
     */
    public function forceDeleted(ActionSignalement $actionSignalement): void
    {
        //
    }
}
