<?php

namespace App\Filament\Resources\SignalementResource\Pages;

use App\Filament\Resources\SignalementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Crypt ;
use Illuminate\Contracts\Encryption\DecryptException;

class EditSignalement extends EditRecord
{
    protected static string $resource = SignalementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    protected function mutateFormDataBeforeFill(array $data): array   
    {
        //Tableaux des champs cryptés
        $tabs = [
            'nature1_autre',
            'nature2_autre',
            'description',
            'periode_eig_autre',
            'consequence1_autre',
            'consequence2_autre',
            'consequence3_autre',
            'secours_non',
            'secours_autre',
            'mesure1',
            'mesure2',
            'mesure3',
            'information_non',
            'information_autre',
            'disposition1_autre',
            'disposition2_autre',
            'disposition3_autre',
            'disposition4_autre',
            'evolution',
            'media1_oui',
            'media2_oui',
            'media3_oui',
            'analyse_groupe_autre',
            'commentaire',
            
        ] ; 

        for($ind = 0 ; $ind < count($tabs) ; $ind++){
            if($data[$tabs[$ind]] != null && !empty($data[$tabs[$ind]])){
                try {
                    $decrypted = Crypt::decrypt($data[$tabs[$ind]]);
                    $decryptionSuccessful = true;
                } catch (DecryptException $e) {
                    $decryptionSuccessful = false;
                }
                if($decryptionSuccessful){
                    $data[$tabs[$ind]] = Crypt::decrypt($data[$tabs[$ind]]) ;
                }
            }  
        }

        return $data ; 

    }

    public function getTitle(): string 
    {
        return 'Modifier le Signalement N°'.$this->record->id ; 
    }
}
