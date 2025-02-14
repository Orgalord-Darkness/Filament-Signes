<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel ; 

enum SignalementCompletEnum: string implements HasLabel 
{
    //
    case OUI = 'Oui' ; 

    case NON = 'Non' ;

    public function getLabel(): ?string 
    {
        return match($this)
        {
            self::OUI => 'Oui', 
            self::NON => 'Non', 
        }; 
    }
}
