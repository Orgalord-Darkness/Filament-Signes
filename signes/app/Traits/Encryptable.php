<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable)) {
            $value = $value ? Crypt::decrypt($value) : "";
        }
        return $value;
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable)) {
            //Forçage en majuscules si Nom
            if ($key == 'nom') {
                $value = strtoupper($value);
            }
            //Cryptage
            $value = Crypt::encrypt($value);
        }
        return parent::setAttribute($key, $value);
    }
}
