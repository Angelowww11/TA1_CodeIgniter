<?= view('partials/header', ['title' => $title]) ?>
<section class="login-layout">
    <div class="login-story" aria-label="SimplePOS store workspace">
        <div class="login-story-top"><span class="story-mark" aria-hidden="true">✳</span><span>THE EVERYDAY STORE</span></div>
        <div class="login-story-photos" aria-hidden="true">
            <img src="<?= base_url('uploads/products/catalog-ceramic-mug.jpg') ?>" alt="">
            <img src="<?= base_url('uploads/products/catalog-notebook.jpg') ?>" alt="">
        </div>
        <div class="login-story-copy"><span class="story-kicker">A BETTER WAY TO RUN THE COUNTER</span><h2>Good days start<br>behind the scenes.</h2><p>Keep your products, people, and every sale in one thoughtful workspace.</p></div>
        <div class="login-story-bottom"><span>INVENTORY</span><span>SALES</span><span>PEOPLE</span></div>
    </div>
    <div class="login-panel">
        <p class="eyebrow">STAFF SIGN IN</p>
        <h1>Welcome back.</h1>
        <p>Sign in to manage your store today.</p>
        <?php if ($signedOut): ?><p class="notice" role="status">You have signed out successfully.</p><?php endif ?>
        <?php if ($error): ?><p class="form-error" role="alert"><?= esc($error) ?></p><?php endif ?>
        <form class="record-form" action="<?= site_url('login') ?>" method="post">
            <?= csrf_field() ?>
            <label>Username<input name="username" required maxlength="50" autocomplete="username" value="<?= esc($username, 'attr') ?>" placeholder="Enter your username"></label>
            <label>Password<input type="password" name="password" required autocomplete="current-password" placeholder="Enter your password"></label>
            <button class="button" type="submit">Sign in <span aria-hidden="true">↗</span></button>
        </form>
        <div class="login-panel-foot">SimplePOS <span>·</span> Store operations</div>
    </div>
</section>
<?= view('partials/footer') ?>
