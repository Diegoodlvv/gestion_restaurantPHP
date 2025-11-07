<?php 

namespace App\Models;

class Commande{

    public function __construct(
        protected Utilisateur 
    )
    {}
}