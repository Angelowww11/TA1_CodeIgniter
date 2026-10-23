<?php
$path = trim(service('uri')->getPath(), '/');
$isActive = static fn (string $route): string => $path === $route ? ' aria-current="page" class="active"' : '';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tasks for Today management dashboard built with CodeIgniter 4.">
    <title><?= esc($title) ?> | Tasks for Today</title>
    <link rel="stylesheet" href="<?= base_url('css/tasks.css') ?>?v=<?= substr(md5_file(FCPATH . 'css/tasks.css'), 0, 12) ?>">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Manrope:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('css/tasks-nature.css') ?>?v=<?= substr(md5_file(FCPATH . 'css/tasks-nature.css'), 0, 12) ?>">
</head>
<body>
<div class="scene-backdrop" aria-hidden="true"><img src="<?= base_url('images/forest-island.png') ?>" alt="" fetchpriority="high"><span class="scene-orbit"></span><i class="scene-leaf" style="--leaf-x:7%;--leaf-size:21px;--leaf-time:13s;--leaf-delay:-2s"></i><i class="scene-leaf" style="--leaf-x:20%;--leaf-size:14px;--leaf-time:17s;--leaf-delay:-12s"></i><i class="scene-leaf" style="--leaf-x:34%;--leaf-size:25px;--leaf-time:16s;--leaf-delay:-6s"></i><i class="scene-leaf" style="--leaf-x:48%;--leaf-size:12px;--leaf-time:12s;--leaf-delay:-8s"></i><i class="scene-leaf" style="--leaf-x:63%;--leaf-size:23px;--leaf-time:18s;--leaf-delay:-15s"></i><i class="scene-leaf" style="--leaf-x:76%;--leaf-size:18px;--leaf-time:14s;--leaf-delay:-5s"></i><i class="scene-leaf" style="--leaf-x:89%;--leaf-size:29px;--leaf-time:19s;--leaf-delay:-9s"></i><i class="scene-leaf" style="--leaf-x:96%;--leaf-size:13px;--leaf-time:15s;--leaf-delay:-12s"></i></div>
    <a class="skip-link" href="#main-content">Skip to content</a>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="<?= site_url('today') ?>">Tasks for Today</a>
            <nav aria-label="Main navigation">
                <a href="<?= site_url('today') ?>"<?= $isActive('today') ?>>Today</a>
                <a href="<?= site_url('tasks') ?>"<?= $isActive('tasks') ?>>All Tasks</a>
                <a href="<?= site_url('tasks/profile') ?>"<?= $isActive('tasks/profile') ?>>Profile</a>
                <a href="<?= site_url('tasks/about') ?>"<?= $isActive('tasks/about') ?>>About</a>
                <?php if (session()->get('task_user_id')): ?>
                    <a href="<?= site_url('tasks/new') ?>"<?= $isActive('tasks/new') ?>>New Task</a>
                    <form method="post" action="<?= site_url('tasks/logout') ?>"><?= csrf_field() ?><button type="submit">Sign out</button></form>
                <?php else: ?>
                    <a href="<?= site_url('tasks/login') ?>"<?= $isActive('tasks/login') ?>>Sign in</a>
                <?php endif ?>
                <a class="activity-link" href="<?= site_url('/') ?>">Midterm POS <span aria-hidden="true">↗</span></a>
            </nav>
        </div>
    </header>
    <main id="main-content" class="container">
