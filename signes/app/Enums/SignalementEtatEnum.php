<?php

namespace App\Enums;
use Filament\Support\Contracts\HasIcon ; 
use Filament\Support\Contracts\HasLabel ; 

enum SignalementEtatEnum:string implements HasLabel, HasIcon 
{
    //

    case OUVERT = 'Ouvert' ; 

    case FERME = 'Fermé' ; 

    case RELANCE = 'Relancé' ; 

    case RECEPTIONNE = 'Réceptionné'  ; 

    case ENCOURS = 'En cours' ; 

    public function getLabel(): ?string 
    {
        return match($this)
        {
            self::OUVERT => 'Ouvert', 
            self::FERME => 'Fermé', 
            self::RELANCE => 'Relancé', 
            self::RECEPTIONNE => 'Réceptionné', 
            self::ENCOURS => 'En cours', 
        }; 
    }

    public function getIcon(): ?string 
    {
        return match($this)
        {
            self::OUVERT => 'heroicon-o-megaphone', 
            self::FERME => 'heroicon-o-eye', 
            self::RELANCE => 'heroicon-o-x-mark', 
            self::RECEPTIONNE => 'heroicon-o-mail', 
            self::ENCOURS => 'heroicon-o-x-mark', 
        }; 
    }
}
