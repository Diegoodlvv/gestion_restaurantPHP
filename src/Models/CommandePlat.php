<?php

namespace App\Models;

class CommandePlat
{
    public function __construct(
        protected Commande $commande,
        protected Plat $plat,
        protected int $quantite
    ) {}

    public function getCommande(): Commande
    {
        return $this->commande;
    }

    public function getPlat(): Plat
    {
        return $this->plat;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }
}
