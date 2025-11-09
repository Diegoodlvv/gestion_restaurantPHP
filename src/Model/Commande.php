<?php

namespace App\Model;

use App\Enum\EnumStatutCommande;
use App\Manager\CommandePlatManager;
use App\Manager\CommandeManager;

class Commande
{

    public function __construct(
        protected Utilisateur $serveur,
        protected EnumStatutCommande $statut,
        protected float $total,
        protected array $plats,
    ) {}

    public function getServeur(): Utilisateur
    {
        return $this->serveur;
    }

    public function getStatut(): EnumStatutCommande
    {
        return $this->statut;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getPlats(): array
    {
        return $this->plats;
    }

    public function setServeur(Utilisateur $nouveauServeur): void
    {
        $this->serveur = $nouveauServeur;
    }

    public function setStatut(EnumStatutCommande $nouveauStatut): void
    {
        $this->statut = $nouveauStatut;
    }

    public function setTotal(float $nouveauTotal): void
    {
        $this->total = $nouveauTotal;
    }

    public function setPlats(array $nouveauPlats): void
    {
        $this->plats = $nouveauPlats;
    }

    public static function arrayToCommande(array $dataCommande): Commande
    {
        $statut = EnumStatutCommande::from($dataCommande['statut']);
        $user = new CommandeManager()->read($dataCommande['serveur_id']);
        $plats = new CommandePlatManager()->getPlatsCommande($dataCommande['id']);

        return new Commande(
            $user,
            $statut,
            $dataCommande['total'],
            $plats
        );
    }
}
