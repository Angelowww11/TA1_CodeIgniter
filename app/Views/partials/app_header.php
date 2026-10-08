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
    <link rel="stylesheet" href="<?= base_url('css/tasks.css') ?>">
</head>
<body>
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
            </nav>
        </div>
    </header>
    <main id="main-content" class="container">
