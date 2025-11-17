<?php

require_once '../includes/head.php';

use App\Manager\UtilisateurManager;
use App\Model\Form;
use App\Model\Error;
use App\Model\Session;
use App\Model\Utilisateur;

$errors = new Error();
$form = new Form($_POST, $errors);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $form->trimData(['email']);
    $form->specialcharsData(['email']);

    if ($form->isEmpty('email') === false) {
        $form->isEmailValid('email');
    }

    $form->isEmpty('password');

    $data = $form->getData();

    if ($errors->isFormValid()) {

        $manager = new UtilisateurManager();

        if (!$manager->authentification($data['email'], $data['password'])) {
            $errors->addError('email', 'Identifiant ou mot de passe incorrect');
        } else {
            $userConnecte = $userBDD;
        }

        if ($userConnecte) {
            Session::newSessionUser('user', $userConnecte);
            UtilisateurManager::redirectionRole($userConnecte);
        }
    }
}
