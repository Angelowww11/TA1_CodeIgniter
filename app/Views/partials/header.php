<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title) ?> | SimplePOS</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="<?= site_url('/') ?>">SimplePOS</a>
            <nav aria-label="Main navigation">
                <?php if (session()->get('auth_user_id')): ?>
                <a href="<?= site_url('customers') ?>">Customers</a>
                <a href="<?= site_url('users') ?>">Users</a>
                <span>Signed in as <?= esc(session()->get('auth_username')) ?></span>
                <form class="logout-form" method="post" action="<?= site_url('logout') ?>">
                    <?= csrf_field() ?><button type="submit">Sign out</button>
                </form>
                <?php else: ?><a href="<?= site_url('login') ?>">Staff login</a><?php endif ?>
            </nav>
        </div>
    </header>
    <main class="container">