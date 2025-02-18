<?php 
namespace App\Filament\Resources\CategorieResource\Pages ; 

use App\Models\Categorie ; 
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckBox;

class FiltersCategorie
{
    public static function getFilters(): array 
    {
        return [
            Filter::make('libelle')
            ->form([
                TextInput::make('libelle')->label('Libellé : ')
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['libelle'], fn (Builder $query, $libelle): Builder => $query->where('libelle',$libelle)); 
            }), 
            // Filter::make('actif')
            // ->form([
            //     CheckBox::make('actif')->label('Actif : ')
            // ])
            // ->query(function (Builder $query, array $data): Builder {
            //     return $query
            //     ->when($data['actif'], fn (Builder $query, $actif): Builder => $query->where('actif',$actif)); 
            // }), 
            Filter::make('code')
            ->form([
                TextInput::make('code')->label('Code : ')
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['code'], fn (Builder $query, $code): Builder => $query->where('code',$code)); 
            }), 

            SelectFilter::make('actif')
                ->options([
                    '1' => 'Actif',
                    '0' => 'Inactif',
                ])
                ->default(null), // Afficher tous les employés par défaut
        ];
    }
}