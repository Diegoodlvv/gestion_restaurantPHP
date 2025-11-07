<?php

namespace App\Enum;

enum EnumStatutCommande: string
{
    case EN_ATTENTE = "en_attente";
    case PRETE = "prete";
    case LIVREE = "livree";
    case EN_PREPARATION = "en_preparation";
}
