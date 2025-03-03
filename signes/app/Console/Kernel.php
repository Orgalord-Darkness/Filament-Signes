<?php

namespace App\Console;

use Carbon\Carbon ;  
use App\Models\Signalement ;
use App\Mail\SignalementRelance;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     * 
     * protected function schedule = Exécute automatiquement la commande relanceSignalement du fichier RelanceSignalement.php
     * 
     * dailyAt('10:00') = Exécutez la tâche tous les jours à 10h00
     * withoutOverlapping = permet d'éviter le chevauchement de plusieurs requêtes
     * appendOutputTo = enregistrer les logs info dans le fichier relanceSignalement.log
     * 
     * Pour tester localement la planification : 
     * - remplacer dailyAt('10:00') par everyMinute() (everyMinute() = Exécutez la tâche toutes les minutes)
     * - exécuter la commande php artisan schedule:work dans le terminal (pour tester une fois exécuter la commande php artisan schedule:run)
     * - consulter les logs pour voir si la planification a fonctionné
     * - le fichier storage\logs\schedule-49888cbba95b67d40ca8c5e09bfe3f88a4c2e767.log actualise une nouvelle ligne si un changement opère
     * - pour stopper php artisan schedule:work, exécuter Ctrl+c dans le terminal

     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('relanceSignalement')->dailyAt('10:00')
            ->withoutOverlapping()
            ->appendOutputTo('relanceSignalement.log');

        $schedule->call(function (){
            $signalements = Signalement::all() ; 

            foreach($signalements as $signalement)
            {
                if($signalement::where('date_evenement', '<=', Carbon::now()->subWeek($signalement->secteur->delai_relance))->get())
                {
                    Mail::to($signalement->email)->send(new SignalementRelance($signalement)) ;
                } 
                if($signalement->isNotEmpty())
                {
                    Mail::to('test.valdoise@gmail.com')->send(new SignalementRelance($signalement)) ;
                } else {
                    Log::info('Aucun utilisateur trouvé pour l\'envoi de l\'email.');
                }
            }
        }) ; 
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
