<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1a241a">
    <title><?= esc($title) ?> | SimplePOS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500;1,600&family=Manrope:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>?v=<?= substr(md5_file(FCPATH . 'css/style.css'), 0, 12) ?>">
    <link rel="stylesheet" href="<?= base_url('css/vivid.css') ?>?v=<?= substr(md5_file(FCPATH . 'css/vivid.css'), 0, 12) ?>">
</head>
<body>
    <a class="skip-link" href="#content">Skip to content</a>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="<?= site_url('/') ?>" aria-label="SimplePOS overview"><span class="brand-icon" aria-hidden="true"><i></i><i></i><i></i><i></i></span><span>simple<span class="brand-accent">pos</span><small>STORE WORKSPACE</small></span></a>
            <nav class="site-nav" aria-label="Main navigation">
                <?php if (session()->get('auth_user_id')): ?>
                    <a href="<?= site_url('/') ?>" <?= uri_string() === '' ? 'aria-current="page"' : '' ?>>Overview</a>
                    <a href="<?= site_url('products') ?>" <?= str_starts_with(uri_string(), 'products') ? 'aria-current="page"' : '' ?>>Products</a>
                    <a href="<?= site_url('sales') ?>" <?= str_starts_with(uri_string(), 'sales') ? 'aria-current="page"' : '' ?>>Sales</a>
                    <a href="<?= site_url('customers') ?>" <?= str_starts_with(uri_string(), 'customers') ? 'aria-current="page"' : '' ?>>Customers</a>
                    <a href="<?= site_url('users') ?>" <?= str_starts_with(uri_string(), 'users') ? 'aria-current="page"' : '' ?>>Staff</a>
                <?php endif ?>
                <a href="<?= site_url('tasks') ?>" <?= str_starts_with(uri_string(), 'tasks') || uri_string() === 'today' ? 'aria-current="page"' : '' ?>>Tasks</a>
            </nav>
            <div class="nav-account">
                <?php if (session()->get('auth_user_id')): ?>
                    <span class="account-name"><span class="account-dot"></span><?= esc(session()->get('auth_username')) ?></span>
                    <form class="logout-form" method="post" action="<?= site_url('logout') ?>"><?= csrf_field() ?><button type="submit">Sign out</button></form>
                <?php else: ?><span class="account-name">Staff access</span><?php endif ?>
            </div>
        </div>
    </header>
    <main id="content" class="container site-main">
