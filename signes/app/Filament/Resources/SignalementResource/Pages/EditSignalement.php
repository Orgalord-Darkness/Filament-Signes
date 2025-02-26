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
    protected static string $resource = SignalementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    protected function mutateFormDataBeforeFill(array $data): array   
    {
        //dd($data) ; 
        //test 
        // $encryptedValue = Crypt::encrypt('test');
        // try {
        //     $decrypted = Crypt::decrypt('eyJpdiI6IlhaVFVDak5oWjRUS3RyK1FpR20wSGc9PSIsInZhbHVlIjoiRlV3cUVlL0dVUVZ1K2Eyakw1ajd4VHRIZWo1K3kxNzQvTlJSVUFPRWRMcmdnYWlOKzBhR1dYaDBlWll2MlhGNHMvMER1UU1MckxEMS9kSXVQZ0kxYzk4ZmNZRkx3cDRoUk1QeGk5VnZhdmc9IiwibWFjIjoiMTM4ZmMzZmJjMTQyNjg4ODQ5MTNlMGRlOTBjYTQ4ZmE2YjdkNTVmMzVhZGQzM2NlMmY2NzlhYTQ2ZDEzNzg1NCIsInRhZyI6IiJ9');
        //     echo $encryptedValue." Valeur déchiffrée : " . $decrypted;
        // } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        //     echo "Erreur de déchiffrement : " . $e->getMessage();
        // }
        //Décryptage des champs
        $data['nature1_autre'] = Crypt::decrypt($data['nature1_autre']) ; //marche pas 
        $data['nature2_autre'] = Crypt::decrypt($data['nature2_autre']) ; //marche pas
        $data['description'] = Crypt::decrypt($data['description']) ; //marche 
        $data['periode_eig_autre'] = Crypt::decrypt($data['periode_eig_autre']) ; //marche pas
        $data['consequence1_autre'] = Crypt::decrypt($data['consequence1_autre']) ; //marche pas
        $data['consequence2_autre'] = Crypt::decrypt($data['consequence2_autre']) ; //marche pas
        $data['consequence3_autre'] = Crypt::decrypt($data['consequence3_autre']) ; //marche pas
        $data['secours_non'] = Crypt::decrypt($data['secours_non']) ; //marche pas
        $data['secours_autre'] = Crypt::decrypt($data['secours_autre']) ; //marche pas
        $data['mesure1'] = Crypt::decrypt($data['mesure1']) ;
        $data['mesure2'] = Crypt::decrypt($data['mesure2']) ;
        $data['mesure3'] = Crypt::decrypt($data['mesure3']) ;
        $data['information_non'] = Crypt::decrypt($data['information_non']) ; //marche pas
        $data['information_autre'] = Crypt::decrypt($data['information_autre']) ; //marche pas
        $data['disposition1_autre'] = Crypt::decrypt($data['disposition1_autre']) ; //marche pas
        $data['disposition2_autre'] = Crypt::decrypt($data['disposition2_autre']) ; //marche pas
        $data['disposition3_autre'] = Crypt::decrypt($data['disposition3_autre']) ; //marche pas
        $data['disposition4_autre'] = Crypt::decrypt($data['disposition4_autre']) ; //marche pas
        $data['evolution'] = Crypt::decrypt($data['evolution']) ;
        $data['media1_oui'] = Crypt::decrypt($data['media1_oui']) ; //marche pas 
        $data['media2_oui'] = Crypt::decrypt($data['media2_oui']) ; //marche pas 
        $data['media3_oui'] = Crypt::decrypt($data['media3_oui']) ; //marche pas 
        $data['analyse_groupe_autre'] = Crypt::decrypt($data['analyse_groupe_autre']) ; //marche pas 
        $data['commentaire'] = Crypt::decrypt($data['commentaire']) ; //marche 

        return $data ; 

    }

    public function getTitle(): string 
    {
        return 'Modifier le Signalement N°'.$this->record->id ; 
    }
}
