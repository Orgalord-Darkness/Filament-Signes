<?php

namespace App\Traits;

use App\Helpers\EncryptionHelper;

trait EncryptionFilesAction
{
    public function encryptFiles($data)
    {
        if (!is_null($data['file'])) {
            $data['file'] = EncryptionHelper::encrypt(($data['file']));
        }
        return $data;
    }

    public function decryptFiles($data)
    {
        if ($data['file']) {
            $data['file'] = EncryptionHelper::decrypt(($data['file']));
        }
        return $data;
    }
}
