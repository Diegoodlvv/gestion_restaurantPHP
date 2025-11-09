<?php

namespace App\Manager;

use App\Model\LoginDatabase;
use App\Model\Plat;

class PlatManager extends LoginDatabase
{
    protected const TABLE = "plat";

    public function bindValuePlat($requete, Plat $plat): void
    {
        $requete->bindValue(':nom', $plat->getNom());
        $requete->bindValue(':description', $plat->getDescription());
        $requete->bindValue(':prix', $plat->getPrix());
        $requete->bindValue(':categorie', $plat->getCategorie());
        $requete->bindValue(':disponible', $plat->getDisponibilitee());
    }

    public function getPlat(int|array $id): ?Plat
    {
        $query = $this->getPdo()->prepare('SELECT * FROM ' . self::TABLE . ' WHERE id = :id');
        $query->bindValue(':id', $id);
        $query->execute();
        $rows = $query->fetch(\PDO::FETCH_ASSOC);

        $plat = Plat::arrayToPlat($rows);

        return $plat;
    }

    public function getPlats(): ?array
    {
        $query = $this->getPdo()->prepare('SELECT * FROM ' . self::TABLE);
        $query->execute();
        $rows = $query->fetchAll(\PDO::FETCH_ASSOC);

        $plats = [];
        foreach ($rows as $row) {
            $plats[] = Plat::arrayToPlat($row);
        }

        if ($plats == null) {
            return null;
        } else {
            return $plats;
        }
    }

    public function add(Plat $plat): ?Plat
    {
        $query = $this->getPdo()->prepare("INSERT INTO " . self::TABLE . " (nom, description, prix, categorie, disponible) values (:nom, :description, :prix, :categorie, :disponible)");
        $this->bindValuePlat($query, $plat);

        $id = $this->getPdo()->lastInsertId();

        if ($id == null) {
            return null;
        } else {
            $commande = $this->getPlat($id);
            return $commande;
        }
    }

    public function deletePlat(?Plat $plat): void
    {
        $query = $this->getPdo()->prepare('DELETE FROM ' . self::TABLE . ' WHERE id = :id');
        $query->bindValue(':id', $plat->getId());
        $query->execute();
    }
}
