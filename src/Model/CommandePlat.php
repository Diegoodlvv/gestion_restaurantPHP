<?php

namespace App\Model;

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

    public function setQuantite(int $nouvelleQuantite): void
    {
        $this->quantite = $nouvelleQuantite;
    }

    public static function arrayToCommandePlat(array $dataCommandePlat): CommandePlat
    {
        $commande = new CommandeManager()->read($dataCommandePlat['commande']);
        $plat = new PlatManager()->read($dataCommandePlat['plat']);

        return new CommandePlat(
            $commande,
            $plat,
            $dataCommandePlat['quantite']
        );
    }
}
