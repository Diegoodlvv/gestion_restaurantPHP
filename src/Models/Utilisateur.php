<?php 

namespace App\Models;

class Utilisateur 
{

    public function __construct
    (
        protected string $nom,
        protected string $email,
        protected string $mdp,
        protected 
    )
    {}
}