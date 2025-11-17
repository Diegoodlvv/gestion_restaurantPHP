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



?>

<div class="page-login">
    <div class="login-layout">
        <main class="login-card" role="main" aria-labelledby="login-title">
            <h2 id="login-title">Se connecter</h2>

            <form class="form-login" method="post" novalidate>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" required
                        placeholder="votre@exemple.com"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        autocomplete="email" />
                </div>
                <?= $form->getChamp('email') ?>

                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" name="password" type="password" required
                        placeholder="••••••••"
                        autocomplete="current-password" />
                </div>
                <?= $form²²->getChamp('password') ?>

                <button class="btn-primary" type="submit">Se connecter</button>
            </form>

            <div class="login-footer">© <?php echo date('Y') ?> Restaurant Manager</div>
        </main>
    </div>
</div>