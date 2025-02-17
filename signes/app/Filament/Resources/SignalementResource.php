<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SignalementResource\Pages;
use App\Filament\Resources\SignalementResource\RelationManagers;
use App\Models\Signalement;
use App\Models\ActionSignalement ; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SignalementResource\Pages\FiltersSignalement ;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Support\Facades\Auth;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction; 
use App\Models\Option ;
use App\Models\Section ;
use Filament\Forms\Components\Grid ; 
use App\Models\Commune ; 
use App\Models\Etablissement ; 
use App\Models\Rubrique ; 
use App\Filament\Resources\SignalementResource\Pages\SignalementFields ; 
use App\Enums\SignalementEtatEnum ; 
use App\Enums\SignalementCompletEnum ; 
use Filament\Tables\Columns\LinkColumn ;
use Symfony\Component\Console\Logger\ConsoleLogger;

class SignalementResource extends Resource
{
    protected static ?string $model = Signalement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Administration';

     protected static ?int $navigationSort = 0 ;

    public static function form(Form $form): Form
    {
        
        return $form
        ->schema([
            SignalementFields::getFields()->columns(1), 
        ]); 
        
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id')
                ->label('N°')
                ->searchable()
                ->sortable()
                ->wrap(),

                Tables\Columns\TextColumn::make('date_evenement')
                ->searchable()
                ->sortable()
                ->wrap(),

                Tables\Columns\TextColumn::make('secteur.libelle')
                ->searchable()
                ->sortable()
                ->wrap(),

                Tables\Columns\TextColumn::make('etablissement.nom')
                ->searchable()
                ->sortable()
                ->wrap(),

                Tables\Columns\TextColumn::make('etat')
                ->searchable()
                ->sortable()
                ->toggleable()
                ->badge()
                ->color(static function($state): string { 
                    if($state === SignalementEtatEnum::OUVERT->getLabel()){
                        return 'danger' ; 
                    }
                    if($state === SignalementEtatEnum::FERME->getLabel()){
                        return 'dark' ; 
                    }
                    if($state === SignalementEtatEnum::RECEPTIONNE->getLabel()){
                        return 'info' ; 
                    }
                    if($state === SignalementEtatEnum::RELANCE->getLabel()){
                        return 'warning' ; 
                    }
                    if($state === SignalementEtatEnum::ENCOURS->getLabel()){
                        return 'success' ; 
                    }
                    return 'dark' ; 
                })
                ->icon(static function($state): string {
                    if($state === SignalementEtatEnum::OUVERT->getLabel())
                    {
                        return SignalementEtatEnum::OUVERT->getIcon() ; 
                    }
                    if($state === SignalementEtatEnum::FERME->getLabel())
                    {
                        return SignalementEtatEnum::FERME->getIcon() ; 
                    }
                    if($state === SignalementEtatEnum::RELANCE->getLabel())
                    {
                        return SignalementEtatEnum::RELANCE->getIcon() ; 
                    }
                    if($state === SignalementEtatEnum::RECEPTIONNE->getLabel())
                    {
                        return SignalementEtatEnum::RECEPTIONNE->getIcon() ; 
                    }
                    if($state === SignalementEtatEnum::ENCOURS->getLabel())
                    {
                        return SignalementEtatEnum::ENCOURS->getIcon() ; 
                    }
                    return ''; 
                })
                ->wrap(),

                Tables\Columns\TextColumn::make('complet')
                ->formatStateUsing(function ($state) {
                    return $state ? 'Oui' : 'Non';
                })
                ->searchable()
                ->sortable()
                ->toggleable()
                ->badge()
                ->color(static function($state): string { 
                    if($state === true){
                        return 'success' ;
                    }
                    if($state === false){
                        return 'danger' ; 
                    }
                    return 'dark' ; 
                })
                ->wrap(),

                Tables\Columns\TextColumn::make('public')
                ->searchable()
                ->sortable()
                ->wrap(),

                Tables\Columns\TextColumn::make('actions_count')
                ->label('Nb Actions')
                ->counts('actions')
                ->sortable()
                ->searchable()
                ->wrap()

                // Tables\Columns\TextColumn::make('actions')
                //->label('Voir Actions')
                ->formatStateUsing(function ($record){
                    $list = [] ; 
                    $actions_signalements = ActionSignalement::all() ; 
                    foreach($actions_signalements as $ligne)
                    {
                        if($ligne['signalement_id'] == $record->id)
                        {
                            $action_id = $ligne['id'] ; 
                            $list[] = $action_id ;
                            
                        }
                    }
                    if(!empty($list) == true){
                        for($ind=0 ; $ind < count($list) ; $ind++){
                            $url = '/admin/action-signalements?tableFilters[id][id]='.$action_id  ;
                            $n = $ind+1 ; 
                            //return "Nb:".count($list)."<a style='font-size:14px;' class='warning'href='$url'>Action N°".$n."</a>" ; Version avec nombre total d'actions 
                            return "<a style='font-size:14px;' class='text-center warning'href='$url'>Action N°".$n."</a>" ; 
                        }
                    }else{
                        return "<p style='font-size:14px;'>Aucune action</p>" ; 
                    }
                })
                ->wrap()
                ->html(), 
            ])
            //->filters(FiltersSignalement::getFilters(), layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifier'),
                Tables\Actions\DeleteAction::make()->label('Supprimer'),
            ])
            ->filters(FiltersSignalement::getFilters(), layout: FiltersLayout::AboveContent)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    FilamentExportBulkAction::make('export')
                    ->label("Télécharger")
                    ->FileName('signalements')
                    ->defaultFormat('xlsx')
                    ->defaultPageOrientation('landscape')
                ]),
            ])->paginated([10,25,50,100,200,300])
            ->defaultSort('id','desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSignalements::route('/'),
            'create' => Pages\CreateSignalement::route('/create'),
            'edit' => Pages\EditSignalement::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count(); 
    }
}
