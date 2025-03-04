<?php

namespace App\Filament\Resources\ActionSignalementResource\Pages;

use App\Filament\Resources\ActionSignalementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Crypt ;
use Illuminate\Contracts\Encryption\DecryptException;

class EditActionSignalement extends EditRecord
{
    protected static string $resource = ActionSignalementResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array   
    {
        $tabs = [
            'question2',
            'reponse'
        ];

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
}
