<?php

namespace App\Helpers;

use App\Jobs\DeleteFileJob;
use Illuminate\Support\Facades\Storage;

class EncryptionHelper
{
    protected const IV = 't123__çàfz46TO';
    
    protected const encryption_key = 'cdvo95';

    public static function encrypt($data)
    {
        if (Storage::exists($data)) {
            Storage::put(auth()->user()->id . $data, openssl_encrypt(Storage::get($data), 'aes-256-cbc', self::encryption_key,0, self::IV));
            Storage::delete($data);

            return auth()->user()->id . $data;
        }
    }
    public static function decrypt($data)
    {
        $decryptedFilePath = 'decrypted/' . $data;
        
        if (Storage::exists($data)) {
            Storage::put($decryptedFilePath, openssl_decrypt(Storage::get($data), 'aes-256-cbc', self::encryption_key,0, self::IV));
            DeleteFileJob::dispatch($decryptedFilePath)->delay(now()->addMinutes(2));
            
            return $decryptedFilePath;
        }
    }
}
