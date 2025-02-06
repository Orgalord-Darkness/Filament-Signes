<?php 
namespace App\Filament\Resources\SecteurResource\Pages ; 

use App\Models\Secteur ;
use App\Models\User ;  
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckBox;
class FiltersSecteur
{
    public static function getFilters(): array 
    {
        return [
            Filter::make('libelle')
            ->form([
                TextInput::make('libelle')->label('Libelle : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['libelle'], fn (Builder $query, $libelle): Builder => $query->where('libelle',$libelle)); 
            }), 
            Filter::make('email')
            ->form([
                TextInput::make('email')->label('1er Courriel : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['email'], fn (Builder $query, $email): Builder => $query->where('email',$email)); 
            }),

            Filter::make('email2')
            ->form([
                TextInput::make('email2')->label('2ème courriel : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['email2'], fn (Builder $query, $email2): Builder => $query->where('email',$email2)); 
            }),

            Filter::make('delai_relance')
            ->form([
                TextInput::make('delai_relance')->label('Délai de relance : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['delai_relance'], fn (Builder $query, $delai_relance): Builder => $query->where('delai_relance',$delai_relance)); 
            }),
            SelectFilter::make('Responsable')
            ->options( function () {
                $users = User::all() ; //Récupérer toutes les valeurs de la table via all pour faire le tableu options
                $options = [] ; 
                foreach($users as $row){
                    if($row->prenom != null &&$row->nom != null){
                        $options[$row->id] = $row->prenom.' '.$row->nom ; 
                    } 
                }
                return $options ; 
            })
            ->attribute('responsable_id'),
        ];
 
    }
}