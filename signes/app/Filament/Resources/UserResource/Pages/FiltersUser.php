<?php 
namespace App\Filament\Resources\UserResource\Pages ; 

use App\Models\User ; 
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckBox;
use App\Models\Secteur;
use App\Models\Etablissement; 

class FiltersUser
{
    public static function getFilters(): array 
    {
        return [
            Filter::make('prenom')
            ->form([
                TextInput::make('prenom')->label('Prénom : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['prenom'], fn (Builder $query, $id): Builder => $query->where('prenom',$id)); 
            }),
            
            Filter::make('nom')
            ->form([
                TextInput::make('nom')->label('Nom : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['nom'], fn (Builder $query, $id): Builder => $query->where('nom',$id)); 
            }),

            SelectFilter::make('civilite')
                ->label('Civilité : ')
                ->options([
                    'M.'=>'M.',
                    'Mme'=>'Mme'
            ]),

            // SelectFilter::make('role')
            // ->label('Rôle : ')
            //     ->options([
            //         'Administrateur'=>'Administrateur',
            //         'Gestionnaire'=>'Gestionnaire',
            //         'Opérateur'=>'Opérateur',
            //         'Utilisateur'=>'Utilisateur',
            //     ])
            // ->attribute('role_has_model'),
            

        ];
 
    }
}