<?php 
namespace App\Filament\Resources\OptionResource\Pages ; 

use App\Models\Option ; 
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckBox;
use App\Models\Section;
use App\Models\Rubrique; 

class FiltersOption
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
            SelectFilter::make('Section')
            ->options( function () {
                $sections = Section::all() ; //Récupérer toutes les valeurs de la table via all pour faire le tableu options
                $options = [] ; 
                foreach($sections as $row){
                    if($row->libelle != null){
                        $options[$row->id] = $row->libelle ; 
                    } 
                }
                return $options ; 
            })
        ->attribute('section_id'),

        SelectFilter::make('Rubrique')
            ->options( function () {
                $rubriques = Rubrique::all() ; //Récupérer toutes les valeurs de la table via all pour faire le tableu options
                $options = [] ; 
                foreach($rubriques as $row){
                    if($row->libelle != null){
                        $options[$row->id] = $row->libelle ; 
                    } 
                }
                return $options ; 
            })
        ->attribute('rubrique_id'),

        Filter::make('ordre')
            ->form([
                TextInput::make('ordre')->label('Ordre : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['ordre'], fn (Builder $query, $ordre): Builder => $query->where('ordre',$ordre)); 
            }),

            Filter::make('actif')
            ->form([
                TextInput::make('actif')->label('Actif : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['actif'], fn (Builder $query, $actif): Builder => $query->where('actif',$actif)); 
            })
        ];
 
    }
}