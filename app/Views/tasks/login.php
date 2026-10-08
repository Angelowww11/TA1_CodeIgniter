<?= view('partials/app_header', ['title' => $title]) ?>
<section class="task-login"><p class="eyebrow">Manager access</p><h1>Sign in to manage tasks</h1><p>The schedule is public. Sign in to add, edit, and archive tasks.</p>
<?php if ($error): ?><p class="task-error"><?= esc($error) ?></p><?php endif ?>
<form method="post" action="<?= site_url('tasks/login') ?>"><?= csrf_field() ?><label for="username">Username</label><input id="username" name="username" required autocomplete="username" value="<?= esc(old('username'), 'attr') ?>"><label for="password">Password</label><input id="password" name="password" type="password" required autocomplete="current-password"><button class="button" type="submit">Sign in</button></form></section>
<?= view('partials/app_footer') ?>
