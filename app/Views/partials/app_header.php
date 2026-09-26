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
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to content</a>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="<?= site_url('/') ?>">Tasks for Today</a>
            <nav aria-label="Main navigation">
                <a href="<?= site_url('/') ?>"<?= $isActive('') ?>>Today</a>
                <a href="<?= site_url('tasks') ?>"<?= $isActive('tasks') ?>>All Tasks</a>
                <a href="<?= site_url('profile') ?>"<?= $isActive('profile') ?>>Profile</a>
                <a href="<?= site_url('about') ?>"<?= $isActive('about') ?>>About</a>
            </nav>
        </div>
    </header>
    <main id="main-content" class="container">
