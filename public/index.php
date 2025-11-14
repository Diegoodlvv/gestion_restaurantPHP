<?php

require_once '../includes/head.php';

use App\Manager\UtilisateurManager;
use App\Model\Form;
use App\Model\Error;

$users = new UtilisateurManager()->getUsers();
$errors = new Error();
$data = new Form($_POST, $errors);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data->trimData();
    $data->specialcharsData();
    $data->isEmpty('email');
    $data->isEmpty('password');
    $data->isEmailValid('email');
}

?>

<div class="page-login">
    <div class="login-layout">
        <main class="login-card" role="main" aria-labelledby="login-title">
            <h2 id="login-title">Se connecter</h2>
            <form class="form-login" method="post" novalidate>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" required placeholder="votre@exemple.com" />
                </div>
                <?= $data->getChamp('email') ?>

                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" name="password" type="password" required placeholder="••••••••" />
                </div>
                <?= $data->getChamp('password') ?>

                <button class="btn-primary" type="submit">Se connecter</button>
            </form>
            <div class="login-footer">© <?php echo new \DateTime()->format('Y') ?> Restaurant Manager</div>
        </main>
    </div>
</div>