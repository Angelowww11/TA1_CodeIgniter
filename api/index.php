<?php

declare(strict_types=1);

if (getenv('VERCEL')) {
    if (strtolower($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https') {
        $_SERVER['HTTPS'] = 'on';
    }
    foreach (['cache', 'logs', 'session', 'debugbar'] as $directory) {
        $path = sys_get_temp_dir() . '/simplepos-writable/' . $directory;
        if (! is_dir($path)) {
            mkdir($path, 0775, true);
        }
    }
}

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$assetPath = realpath(dirname(__DIR__) . '/public' . $path);
$publicRoot = realpath(dirname(__DIR__) . '/public');

if (
    $assetPath !== false
    && $publicRoot !== false
    && str_starts_with($assetPath, $publicRoot . DIRECTORY_SEPARATOR)
    && is_file($assetPath)
    && preg_match('/\.(?:css|js|svg|png|jpe?g|webp|ico|woff2?)\z/i', $assetPath)
) {
    $types = [
        'css' => 'text/css; charset=utf-8', 'js' => 'text/javascript; charset=utf-8',
        'svg' => 'image/svg+xml', 'png' => 'image/png', 'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg', 'webp' => 'image/webp', 'ico' => 'image/x-icon',
        'woff' => 'font/woff', 'woff2' => 'font/woff2',
    ];
    $extension = strtolower(pathinfo($assetPath, PATHINFO_EXTENSION));
    header('Content-Type: ' . $types[$extension]);
    header('Cache-Control: public, max-age=86400, stale-while-revalidate=604800');
    readfile($assetPath);
    exit;
}

require dirname(__DIR__) . '/public/index.php';
