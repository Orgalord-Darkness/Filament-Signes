<?php

namespace App\Traits;

use App\Helpers\EncryptionHelper;

trait EncryptionFilesSignalement
{
    public function encryptFiles($data)
    {
        for ($i = 1; $i<5; $i++){
            if (is_null($data['file_'.$i])) {
                break;
            }
            $data['file_'.$i] = EncryptionHelper::encrypt(($data['file_'.$i]));
        }

        if (!is_null($data['file_courrier'])) {
            $data['file_courrier'] = EncryptionHelper::encrypt(($data['file_courrier']));
        }
        return $data;
    }

    public function decryptFiles($data)
    {
        for ($i = 1; $i<5; $i++){
            if (is_null($data['file_'.$i])){
                break;
            }
            $data['file_'.$i] = EncryptionHelper::decrypt(($data['file_'.$i]));
        }

        if ($data['file_courrier']) {
            $data['file_courrier'] = EncryptionHelper::decrypt(($data['file_courrier']));
        }
        return $data;
    }
}
