<?php 
namespace App\Filament\Resources\SignalementResource\Pages ; 

use App\Models\Signalement ; 
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckBox;
use App\Models\Secteur;
use App\Models\Etablissement; 

class SignalementFilters
{
    public static function getFilters(): array 
    {
        return [
            Filter::make('id')
            ->form([
                TextInput::make('id')->label('Id : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['id'], fn (Builder $query, $id): Builder => $query->where('id',$id)); 
            }), 
            Filter::make('date_evenement')
            ->form([
                DatePicker::make('date_evenement')->label('Date : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                    ->when($data['date_evenement'], fn (Builder $query, $date): Builder => $query->whereDate('date_evenement', $date));
            }),
            SelectFilter::make('Secteur')
            ->options( function () {
                $sections = Secteur::all() ; //Récupérer toutes les valeurs de la table via all pour faire le tableu options
                $options = [] ; 
                foreach($sections as $row){
                    if($row->libelle != null){
                        $options[$row->id] = $row->libelle ; 
                    } 
                }
                return $options ; 
            })
        ->attribute('secteur_id'),

        SelectFilter::make('Etablissement')
            ->options( function () {
                $etablissements = Etablissement::all() ; //Récupérer toutes les valeurs de la table via all pour faire le tableu options
                $options = [] ; 
                foreach($etablissements as $row){
                    if($row->nom != null){
                        $options[$row->id] = $row->nom ; 
                    } 
                }
                return $options ; 
            })
        ->attribute('etablissement_id'),

        Filter::make('etat')
            ->form([
                TextInput::make('etat')->label('etat : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['etat'], fn (Builder $query, $statut): Builder => $query->where('etat',$statut)); 
            }),

            Filter::make('complet')
            ->form([
                TextInput::make('complet')->label('Complet : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['complet'], fn (Builder $query, $complet): Builder => $query->where('complet',$complet)); 
            })
            
        ];
 
    }
}