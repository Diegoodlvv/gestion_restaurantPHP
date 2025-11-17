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

    public static function redirectionRole(Utilisateur $user): void
    {
        if (!$user) {
            header('Location: login.php');
        }

        if ($user->getRole()->name == 'serveur') {
            header('Location: serveur/home.php');
        } else if ($user->getRole()->name == 'manager') {
            header('Location: manager/home.php');
        } else if ($user->getRole()->name == 'chef') {
            header('Location: chef/home.php');
        }
    }

    public  function verifyUserExistance(string $email, array $users): bool
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

    public function authentification(string $mail, string $password)
    {
        $users = $this->getUsers();

        foreach ($users as $userBDD) {
            if ($userBDD->getEmail() == $mail && password_verify($password, $userBDD->getMdp())) {
                return $userBDD;
            }
        }

        return false;
    }
}
