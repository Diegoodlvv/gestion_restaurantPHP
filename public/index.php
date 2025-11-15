<?php

require_once '../includes/head.php';

use App\Manager\UtilisateurManager;
use App\Model\Form;
use App\Model\Error;
use App\Model\Utilisateur;

$errors = new Error();
$data = new Form($_POST, $errors);
$loginError = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token');
    }

    $data->trimData(['email']);
    $data->specialcharsData(['email']);
    $data->isEmpty('email');
    $data->isEmpty('password');
    $data->isEmailValid('email');

    // If no validation errors, attempt login
    if (!$errors->isFormValid()) {
    }
}

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

?>

<div class="page-login">
    <div class="login-layout">
        <main class="login-card" role="main" aria-labelledby="login-title">
            <h2 id="login-title">Se connecter</h2>

            <?php if ($loginError): ?>
                <div class="alert alert-error" role="alert">
                    <?= htmlspecialchars($loginError) ?>
                </div>
            <?php endif; ?>

            <form class="form-login" method="post" novalidate>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="input-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" required
                        placeholder="votre@exemple.com"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        autocomplete="email" />
                </div>
                <?= $data->getChamp('email') ?>

                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" name="password" type="password" required
                        placeholder="••••••••"
                        autocomplete="current-password" />
                </div>
                <?= $data->getChamp('password') ?>

                <button class="btn-primary" type="submit">Se connecter</button>
            </form>

            <div class="login-links">
                <a href="/forgot-password.php">Mot de passe oublié ?</a>
            </div>

            <div class="login-footer">© <?php echo date('Y') ?> Restaurant Manager</div>
        </main>
    </div>
</div>