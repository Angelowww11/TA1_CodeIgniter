<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#173a34">
    <title><?= esc($title) ?> | SimplePOS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Manrope:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>?v=<?= substr(md5_file(FCPATH . 'css/style.css'), 0, 12) ?>">
    <link rel="stylesheet" href="<?= base_url('css/vivid.css') ?>?v=<?= substr(md5_file(FCPATH . 'css/vivid.css'), 0, 12) ?>">
</head>
<body>
<div class="scene-backdrop" aria-hidden="true"><img src="<?= base_url('images/forest-island.png') ?>" alt="" fetchpriority="high"><span class="scene-orbit"></span><i class="scene-leaf" style="--leaf-x:7%;--leaf-size:21px;--leaf-time:13s;--leaf-delay:-2s"></i><i class="scene-leaf" style="--leaf-x:20%;--leaf-size:14px;--leaf-time:17s;--leaf-delay:-12s"></i><i class="scene-leaf" style="--leaf-x:34%;--leaf-size:25px;--leaf-time:16s;--leaf-delay:-6s"></i><i class="scene-leaf" style="--leaf-x:48%;--leaf-size:12px;--leaf-time:12s;--leaf-delay:-8s"></i><i class="scene-leaf" style="--leaf-x:63%;--leaf-size:23px;--leaf-time:18s;--leaf-delay:-15s"></i><i class="scene-leaf" style="--leaf-x:76%;--leaf-size:18px;--leaf-time:14s;--leaf-delay:-5s"></i><i class="scene-leaf" style="--leaf-x:89%;--leaf-size:29px;--leaf-time:19s;--leaf-delay:-9s"></i><i class="scene-leaf" style="--leaf-x:96%;--leaf-size:13px;--leaf-time:15s;--leaf-delay:-12s"></i></div>
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
                <a class="activity-link" href="<?= site_url('today') ?>">TSA2 Tasks <span aria-hidden="true">↗</span></a>
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
