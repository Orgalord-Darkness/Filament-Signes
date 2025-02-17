<?php 
namespace App\Filament\Resources\EtablissementResource\Pages ; 

use App\Models\Signalement ; 
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckBox;
use App\Models\Secteur;
use App\Models\Etablissement; 
use App\Models\User ; 

class EtablissementFilters 
{
    public static function getFilters(): array 
    {
        return [
            Filter::make('nom')
            ->form([
                TextInput::make('nom')->label('Nom : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['nom'], fn (Builder $query, $id): Builder => $query->where('nom',$id)); 
            }),
        ] ; 
    }
}