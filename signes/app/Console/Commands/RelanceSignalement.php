<?php

namespace App\Console\Commands;

use Exception;
use App\Models\Secteur;
use App\Models\Signalement;
use Illuminate\Console\Command;
use App\Mail\SignalementRelance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RelanceSignalement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'relanceSignalement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoi des courriels de relance sur le signalements Ouverts et En cours du Secteur sélectionné';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $secteurs = Secteur::all();

        foreach ($secteurs as $secteur) {

            // Sélection des signalements complets à l'état En cours du secteur dont le délai de relance en semaines est dépassé
            $signalements = Signalement::where('etat', 'En cours')
                ->where('complet', true)
                ->where('secteur_id', $secteur->id)
                ->where('date', '<', date('Y-m-d', strtotime(today(). ' - '.($secteur->delai_relance*7).' days')))
                ->get();

            $cptRelance = 0;
            $cptErreur = 0;

            foreach ($signalements as $signalement) {
                try {
                    // Démarrage de la transaction
                    DB::beginTransaction();
                
                    //Mise à jour du signalement à l'état Relancé
                    $signalement->etat = 'Relancé';
                    
                    // Sauvegarde en base
                    $signalement->save();

                    //Envoi mail de Relance
                    try {
                        Mail::to('test.valdoise@gmail.com')->send(new SignalementRelance($signalement));
                    }
                    catch (Exception $exception) {
                        Log::channel('emailError')->error($exception->getMessage(),  ['signalement' => $signalement]);
                    }

                    // Commit de la transaction
                    DB::commit();

                    Log::channel($this->signature)->info('Signalement N° '.$signalement->id.' de '.$signalement->declarant);
                    $this->info('Signalement N° '.$signalement->id.' de '.$signalement->declarant);

                    $cptRelance++;

                } catch (Exception $exception) {
                    // Rollback de la transaction
                    DB::rollback();

                    $cptErreur++;

                    Log::channel($this->signature)->error('Signalement N° '.$signalement->id.' de '.$signalement->declarant.' : '.$exception->getMessage());
                    $this->error('Signalement N° '.$signalement->id.' de '.$signalement->declarant.' : '.$exception->getMessage());
                }
            }
            Log::channel($this->signature)->info('--------------------------------------------------');
            $this->info('--------------------------------------------------');

            if ($cptRelance == 0) {
                Log::channel($this->signature)->info('Aucun signalement modifié sur le secteur '.$secteur->libelle);
                Log::channel($this->signature)->info('--------------------------------------------------');
                $this->info('Aucun signalement modifié sur le secteur '.$secteur->libelle);
                $this->info('--------------------------------------------------');
            }
            if ($cptRelance > 0) {
                Log::channel($this->signature)->info($cptRelance . ' signalement.s relancé.s sur le secteur '.$secteur->libelle);
                Log::channel($this->signature)->info('--------------------------------------------------');
                $this->info($cptRelance . ' signalement.s relancé.s sur le secteur '.$secteur->libelle);
                $this->info('--------------------------------------------------');
            }
            if ($cptErreur > 0) {
                Log::channel($this->signature)->error($cptErreur . ' signalement.s NON relancés sur le secteur '.$secteur->libelle);
                Log::channel($this->signature)->error('--------------------------------------------------');
                $this->error($cptErreur . ' signalement.s NON relancés sur le secteur '.$secteur->libelle);
                $this->error('--------------------------------------------------');
            }
        }
    }
}
