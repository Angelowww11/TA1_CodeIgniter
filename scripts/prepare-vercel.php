<?php

$root = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . '/simplepos-writable';
foreach (['cache', 'logs', 'session', 'debugbar'] as $directory) {
    $path = $root . DIRECTORY_SEPARATOR . $directory;
    if (! is_dir($path)) {
        mkdir($path, 0775, true);
    }
}
