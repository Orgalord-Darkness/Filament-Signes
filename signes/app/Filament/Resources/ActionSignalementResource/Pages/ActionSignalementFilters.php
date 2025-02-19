<?php 
namespace App\Filament\Resources\ActionSignalementResource\Pages ; 

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

// class FiltersActionSignalement 
// {
//     public static function getFilters(): array 
//     {
//         return [
//             Filter::make('id')
//             ->form([
//                 TextInput::make('id')->label('Id : '),
//             ])
//             ->query(function (Builder $query, array $data): Builder {
//                 return $query
//                 ->when($data['id'], fn (Builder $query, $id): Builder => $query->where('id',$id)); 
//             }),
//             SelectFilter::make('User')
//             ->options( function () {
//                 $utilisateurs = User::all() ; //Récupérer toutes les valeurs de la table via all pour faire le tableu options
//                 $options = [] ; 
//                 foreach($utilisateurs as $row){
//                     if($row->nom != null){
//                         $options[$row->id] = $row->nom ; 
//                     } 
//                 }
//                 return $options ; 
//             })
//             ->attribute('user_id'),
            
//             SelectFilter::make('Signalement')
//             ->options( function () {
//                 $signalements = Signalement::all() ; //Récupérer toutes les valeurs de la table via all pour faire le tableu options
//                 $options = [] ; 
//                 foreach($signalements as $row){
//                     if($row->id != null){
//                         $options[$row->id] = $row->id ; 
//                     } 
//                 }
//                 return $options ; 
//             })
//             ->attribute('signalement_id'),
//         ] ; 
//     }
// }