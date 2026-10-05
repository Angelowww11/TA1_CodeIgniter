<?= view('partials/header', ['title' => $title]) ?>
<section class="login-panel">
    <p class="eyebrow">Staff access</p>
    <h1>Sign in to SimplePOS</h1>
    <p>Use your staff account to manage customers and users.</p>
    <?php if ($signedOut): ?><p class="notice" role="status">You have signed out successfully.</p><?php endif ?>
    <?php if ($error): ?><p class="form-error" role="alert"><?= esc($error) ?></p><?php endif ?>
    <form class="record-form" action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>
        <label>Username<input name="username" required maxlength="50" autocomplete="username" value="<?= esc($username, 'attr') ?>"></label>
        <label>Password<input type="password" name="password" required autocomplete="current-password"></label>
        <button class="button" type="submit">Sign in</button>
    </form>
</section>
<?= view('partials/footer') ?>
