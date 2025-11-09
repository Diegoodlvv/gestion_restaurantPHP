<?php

namespace App\Model;

use App\Enum\EnumRoleUtilisateur;

class Utilisateur
{

    public function __construct(
        protected string $nom,
        protected string $email,
        protected string $mdp,
        protected EnumRoleUtilisateur $role,
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMdp(): string
    {
        return $this->mdp;
    }

    public function setMdp(string $nouveauMdp): void
    {
        $this->mdp = password_hash($nouveauMdp, PASSWORD_BCRYPT);
    }

    public function getRole(): EnumRoleUtilisateur
    {
        return $this->role;
    }

    public function setRole(EnumRoleUtilisateur $nouveauRole): void
    {
        $this->role = $nouveauRole;
    }

    public static function arrayToUser(array $dataUser): Utilisateur
    {
        $role = EnumRoleUtilisateur::from($dataUser['role']);
        return new Utilisateur(
            $dataUser['nom'],
            $dataUser['email'],
            $dataUser['mot_de_passe'],
            $role,
            $dataUser['id']
        );
    }
}
