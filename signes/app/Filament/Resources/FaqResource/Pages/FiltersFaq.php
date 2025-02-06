<?php 
namespace App\Filament\Resources\FaqResource\Pages ; 

use App\Models\Faq ; 
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckBox;
use App\Models\CatFaq; 

class FiltersFaq
{
    public static function getFilters(): array 
    {
        return [
            Filter::make('question')
            ->form([
                TextInput::make('question')->label('Question : '),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                ->when($data['question'], fn (Builder $query, $question): Builder => $query->where('question',$question)); 
            }), 
            SelectFilter::make('Grade')
            ->options( function () {
                $catfaqs = CatFaq::all() ; //Récupérer toutes les valeurs de la table via all pour faire le tableu options
                $options = [] ; 
                foreach($catfaqs as $row){
                    if($row->libelle != null){
                        $options[$row->id] = $row->libelle ; 
                    } 
                }
                return $options ; 
            })
        ->attribute('catfaq_id'),

        ];
    }
}