<?php
// Router for `php -S localhost:8000 router.php`.
// The built-in server doesn't read .htaccess, so this sends every request
// that isn't an existing file through index.php.

$path = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($path !== '/' && file_exists(__DIR__ . $path) && is_file(__DIR__ . $path)) {
    return false; // serve the requested resource as-is (e.g. an asset)
}

require __DIR__ . '/index.php';
