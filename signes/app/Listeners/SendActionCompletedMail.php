<?php

namespace App\Listeners;

use App\Events\EnvoieMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\Test;

class SendActionCompletedMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EnvoieMail $event): void
    {
        //
        $data = [
            'title' => 'Action Complétée',
            'message' => 'L\'action a été complétée avec succès.'
        ];

        Mail::to('destinataire@example.com')->send(new Test($data));
    }
}
