<?= view('partials/app_header', ['title' => $title]) ?>

<section class="page-heading" aria-labelledby="profile-title">
    <p class="eyebrow">Demo account</p><h1 id="profile-title">Profile</h1>
    <p>The single user record stored in the users table and retrieved through UserModel.</p>
</section>

<section>
    <?php if ($user === null): ?>
        <div class="card"><h2>No user found</h2><p>Run the database seeder to create the required demo account.</p></div>
    <?php else: ?>
        <article class="card profile-card">
            <span class="card-number">SYSTEM DEVELOPER</span>
            <div>
                <h2><?= esc($user['full_name']) ?></h2>
                <a href="mailto:<?= esc($user['email'], 'attr') ?>"><?= esc($user['email']) ?></a>
            </div>
            <dl>
                <div><dt>Username</dt><dd><?= esc($user['username']) ?></dd></div>
                <div><dt>Member since</dt><dd><?= esc(date('F j, Y', strtotime($user['created_at']))) ?></dd></div>
            </dl>
        </article>
    <?php endif ?>
</section>

<?= view('partials/app_footer') ?>
