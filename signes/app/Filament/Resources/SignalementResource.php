<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SignalementResource\Pages;
use App\Filament\Resources\SignalementResource\RelationManagers ; 
use App\Filament\Resources\SignalementResource\RelationManagers\SignalementRelationManager ; 
use App\Models\Signalement;
use App\Models\ActionSignalement ; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SignalementResource\Pages\SignalementFilters ;
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
use App\Filament\Resources\SignalementResource\Pages\SignalementColumns ; 
use App\Enums\SignalementEtatEnum ; 
use App\Enums\SignalementCompletEnum ; 
use Filament\Tables\Columns\LinkColumn ;
use Symfony\Component\Console\Logger\ConsoleLogger;
use App\Mail\Test; 
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;

class SignalementResource extends Resource
{
    protected static ?string $model = Signalement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Gestion';

    protected static ?string $pluralLabel = 'Signalements';

    protected static ?string $label = 'un signalement' ; 

    protected static ?int $navigationSort = 1 ;

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
            ->columns(SignalementColumns::getColumns())
            ->headerActions([
                Tables\Actions\Action::make('envoyerMail')
                    ->label('Envoyer un mail')
                    ->action(function () {
                        try {
                            $data = [
                                'title' => 'Titre du Mail de Test',
                                'message' => 'Ceci est un message de test.'
                            ];
                            Mail::to('heddy.mameri@gmail.com')->send(new Test($data));
                            Notification::make()
                                ->title('Mail envoyé avec succès !')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Échec de l\'envoi du mail.')
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            //->filters(FiltersSignalement::getFilters(), layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifier'),
                Tables\Actions\DeleteAction::make()->label('Supprimer'), 
            ])
            ->filters(SignalementFilters::getFilters(), layout: FiltersLayout::AboveContent)
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
            SignalementRelationManager::class, 
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

    public static function getModel(): string
    {
        return Signalement::class;
    }

    protected function handleRecordCreation(array $data) 
    {   
        $required = [
            'secteur_id' => 1, 
            'etablissement_id' => 1,
            'public' => 'saisir public',
            'etat' => 'Non complet',
            'fonction_id' => 1,
        ] ; 
        if($data['complet'] === false){
            return static::getModel()::create([
                $data['secteur_id'] => 1, 
                $data['etablissement_id'] => 1,
                $data['public'] => 'saisir public',
                $data['etat'] => 'Non complet',
                $data['fonction_id'] => 1,
            ]) ; 
        }else{
            return static::getModel()::create($data) ; 
        }
    }
} 
