<?php

namespace App\Manager;

use App\Model\LoginDatabase;
use App\Model\Utilisateur;

class UtilisateurManager extends LoginDatabase
{
    protected const TABLE = 'utilisateur';

    public function getUsers(): array
    {
        $query = $this->getPdo()->prepare('SELECT * FROM ' . self::TABLE);
        $query->execute();
        $rows = $query->fetchAll(\PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $users[] = Utilisateur::arrayToUser($row);
        }

        return $users;
    }

    public function verifyServeur(Utilisateur $user): void
    {
        if ($user->getRole()->name == 'serveur') {
            header('Location: index.php');
        }
    }

    public function verifyUserExistance(string $email, array $users): bool
    {
        foreach ($users as $user) {
            if ($email === $user->getEmail()) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }
}
