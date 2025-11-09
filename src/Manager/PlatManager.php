<?php

namespace App\Manager;

use App\Model\LoginDatabase;
use App\Model\Plat;

class PlatManager extends LoginDatabase
{
    protected const TABLE = "plat";

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
}
