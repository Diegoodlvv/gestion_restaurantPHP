<?php

namespace App\Enum;


enum EnumRoleUtilisateur: string
{
    case CHEF = "chef";
    case SERVEUR = "serveur";
    case LIVREUR = "livreur";
}
