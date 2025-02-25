<?php

namespace App\Filament\Resources\SignalementResource\Pages;

use App\Filament\Resources\SignalementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Crypt ;
use App\Traits\EncryptionFilesSignalement ;
use Hamcrest\Core\HasToString;

class EditSignalement extends EditRecord
{
    use EncryptionFilesSignalement ; 
    protected static string $resource = SignalementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array   
    {
        //test 
        $encryptedValue = Crypt::encrypt('test');
        try {
            $decrypted = Crypt::decrypt($encryptedValue);
            echo "Valeur déchiffrée : " . $decrypted;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            echo "Erreur de déchiffrement : " . $e->getMessage();
        }
        //Décryptage des champs
        $data['nature1_autre'] = Crypt::decrypt($data['nature1_autre']) ;
        $data['nature2_autre'] = Crypt::decrypt($data['nature2_autre']) ;
        $data['description'] = Crypt::decrypt($data['description']) ;
        $data['periode_eig_autre'] = Crypt::decrypt($data['periode_eig_autre']) ; 
        $data['consequence1_autre'] = Crypt::decrypt($data['consequence1_autre']) ;
        $data['consequence2_autre'] = Crypt::decrypt($data['consequence2_autre']) ;
        $data['consequence3_autre'] = Crypt::decrypt($data['consequence3_autre']) ;
        $data['secours_non'] = Crypt::decrypt($data['secours_non']) ;
        $data['secours_autre'] = Crypt::decrypt($data['secours_autre']) ;
        $data['mesure1'] = Crypt::decrypt($data['mesure1']) ;
        $data['mesure2'] = Crypt::decrypt($data['mesure2']) ;
        $data['mesure3'] = Crypt::decrypt($data['mesure3']) ;
        $data['information_non'] = Crypt::decrypt($data['information_non']) ;
        $data['information_autre'] = Crypt::decrypt($data['information_autre']) ;
        $data['disposition1_autre'] = Crypt::decrypt($data['disposition1_autre']) ;
        $data['disposition2_autre'] = Crypt::decrypt($data['disposition2_autre']) ;
        $data['disposition3_autre'] = Crypt::decrypt($data['disposition3_autre']) ;
        $data['disposition4_autre'] = Crypt::decrypt($data['disposition4_autre']) ;
        $data['media1_oui'] = Crypt::decrypt($data['media1_oui']) ;
        $data['media2_oui'] = Crypt::decrypt($data['media2_oui']) ;
        $data['media3_oui'] = Crypt::decrypt($data['media3_oui']) ;
        $data['analyse_groupe_autre'] = Crypt::decrypt($data['analyse_groupe_autre']) ;
        $data['commentaire'] = Crypt::decrypt($data['commentaire']) ;

        return $data ; 

    }

    public function getTitle(): string 
    {
        return 'Modifier le Signalement N°'.$this->record->id ; 
    }
}
