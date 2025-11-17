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
                <?= $form->getChamp('password') ?>

                <button class="btn-primary" type="submit">Se connecter</button>
            </form>

            <div class="login-footer">© <?php echo date('Y') ?> Restaurant Manager</div>
        </main>
    </div>
</div>