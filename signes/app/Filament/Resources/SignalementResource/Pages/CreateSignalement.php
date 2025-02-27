<?php

namespace App\Filament\Resources\SignalementResource\Pages;

use App\Filament\Resources\SignalementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;

class CreateSignalement extends CreateRecord
{
    protected static string $resource = SignalementResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('saveDraft')
                ->label('Enregistrer la saisie')
                ->action(function (){
                    $data = $this->form->getState();
                    $data['complet'] = false ; 
                    $this->record = $this->handleRecordCreation($data) ; 
                    dd($data) ; 
                }),
        ];
    }
    
}
