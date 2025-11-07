<?php

namespace App\Models;

use App\Enum\EnumCategoriePlat;

class Plat
{

    public function __construct(
        protected string $nom,
        protected string $description,
        protected float $prix,
        protected EnumCategoriePlat $categorie,
        protected int $disponible,
        protected ?int $id = null
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nouveauNom): void
    {
        $this->nom = $nouveauNom;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $nouvelleDescription): void
    {
        $this->description = $nouvelleDescription;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function setPrix(float $nouveauPrix): void
    {
        $this->prix = $nouveauPrix;
    }

    public function getCategorie(): EnumCategoriePlat
    {
        return $this->categorie;
    }

    public function getDisponibilitee(): int
    {
        return $this->disponible;
    }

    public function setDisponibilitee(int $nouvelleDisponibilitee): void
    {
        $this->disponible = $nouvelleDisponibilitee;
    }

    public static function arrayToPlat(array $dataPlat): Plat
    {
        $categorie = EnumCategoriePlat::from($dataPlat['categorie']);
        return new Plat(
            $dataPlat['nom'],
            $dataPlat['description'],
            $dataPlat['prix'],
            $categorie,
            $dataPlat['disponible'],
            $dataPlat['id']
        );
    }

    public static function redirection(): void
    {
        header("Location: add_commande.php");
    }
}
