<?php

namespace App\Manager;

use App\Model\Commande;
use App\Model\LoginDatabase;

class CommandeManager extends LoginDatabase
{
    protected const TABLE = "commande";

    public function bindValueCommande($query, Commande $commande): void
    {
        $query->bindValue(':serveur_id', $commande->getServeur()->getId());
        $query->bindValue('statut', $commande->getStatut());
        $query->bindValue(':total', $commande->getTotal());
        $query->execute();
    }

    public function getCommande(array|int $id): ?object
    {
        $query = $this->getPdo()->prepare('SELECT * FROM ' . self::TABLE . " WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $rows = $query->fetch(\PDO::FETCH_ASSOC);

        $commande = Commande::arrayToCommande($rows);

        if ($commande == null) {
            return null;
        } else {
            return $commande;
        }
    }

    public function getCommandes(): ?array
    {
        $query = $this->getPdo()->prepare('SELECT * FROM ' . self::TABLE);
        $query->execute();
        $rows = $query->fetchAll(\PDO::FETCH_ASSOC);

        $commandes = [];
        foreach ($rows as $row) {
            $commandes[] = Commande::arrayToCommande($row);
        }

        if ($commandes == null) {
            return null;
        } else {
            return $commandes;
        }
    }

    public function getCommandesByStatut(string $statut): ?array
    {
        $query = $this->getPdo()->prepare('SELECT * FROM ' . self::TABLE . ' WHERE statut = :statut');
        $query->bindValue(':statut', $statut);
        $query->execute();

        $rows = $query->fetchAll(\PDO::FETCH_ASSOC);

        $commandes = [];
        foreach ($rows as $row) {
            $commandes[] = Commande::arrayToCommande($row);
        }

        return $commandes;
    }

    public function getTotalByDay(\DateTime $date): ?float
    {
        $query = $this->getpdo()->prepare('SELECT SUM(total) AS total_jour FROM ' . self::TABLE . ' WHERE DATE(date_commande) = :date');
        $query->bindValue(':date', $date);
        $query->execute();

        $total = $query->fetch(\PDO::FETCH_ASSOC);

        return $total;
    }

    public function getTotalByMonth(int $month, int $year): ?float
    {
        $query = $this->getPdo()->prepare('SELECT SUM(total) FROM ' . self::TABLE . ' WHERE MONTH(date_commande) = :month AND YEAR(date_commande) = :year');
        $query->bindValue(':month', $month);
        $query->bindValue(':year', $year);
        $query->execute();

        $total = $query->fetch(\PDO::FETCH_ASSOC);

        return $total;
    }

    public function getTotalByYear(int $year): ?int
    {
        $query = $this->getPdo()->prepare('SELECT SUM(total) FROM ' . self::TABLE . ' WHERE YEAR(date_commande) = :year');
        $query->bindValue(':year', $year);
        $query->execute();

        $total = $query->fetch(\PDO::FETCH_ASSOC);

        return $total;
    }


    public function add(Commande $commande): ?Commande
    {
        $query = $this->getPdo()->prepare("INSERT INTO " . self::TABLE . " (serveur_id, statut, total) values (:serveur_id, :statut, :total)");
        $this->bindValueCommande($query, $commande);

        $id = $this->getPdo()->lastInsertId();

        if ($id == null) {
            return null;
        } else {
            $commande = $this->getCommande($id);
            return $commande;
        }
    }
}
