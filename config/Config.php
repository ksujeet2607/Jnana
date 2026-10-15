<?php

declare(strict_types=1);

$config = [
    /**
     * Database configuration.
     * Left empty by default so a fresh install boots with NullDatabase and
     * no real DB connection is required to see the welcome page.
     * Set DB_DATABASE in .env (and the other DB_* vars) to enable it.
     */
    'db' => getenv('DB_DATABASE')
        ? [
            'host' => getenv('DB_HOST') ?: 'localhost',
            'user' => getenv('DB_USERNAME') ?: 'root',
            'password' => getenv('DB_PASSWORD') ?: '',
            'dbname' => getenv('DB_DATABASE'),
            'driver' => getenv('DB_DRIVER') ?: 'pdo_mysql',
        ]
        : [],

    /**
     * Maintenance Mode settings.
     * Allow ips to enable page views
     */
    'maintenance' => [
        'allowed_ips' => [],
        'bypass_routes' => [],
    ],

    /**
     * Pre controller middleware.
     * These middlewares will be executed just before calling controller
     * and its own middlewares.
     */
    'pre_controller_middlewares' => [
        \Jnana\Middleware\SecurityHeadersMiddleware::class,
        \Jnana\Middleware\MaintenanceMiddleware::class,
        \Jnana\Middleware\CsrfMiddleware::class,
    ],

    /**
     * Post controller middleware.
     * These middlewares will be executed just after calling controller method.
     */
    'post_controller_middlewares' => [
        \Jnana\Middleware\ClearOldInputMiddleware::class,
    ],

    /**
     * Dependency Injection (DI) definitions.
     * Predefined services loaded into the container.
     */
    'definitions' => file_exists(__DIR__ . '/Dependencies.php')
        ? include __DIR__ . '/Dependencies.php'
        : [],

    /**
     * Routing namespaces.
     * Array of namespaces where the application's routes are registered.
     */
    'routes' => [
        'App\\Controllers',
    ],

    /**
     * Debugging flag.
     * Enable or disable the display of current route information at the end of each request.
     */
    'show_current_route_info' => getenv('APP_ENV') === 'development',

    /**
     * set authentication strategy
     * Defaults to 'file' (config/users.json) so a fresh install works
     * without a database. Switch to 'database' once you've configured 'db'
     * above and created a users table.
     */
    'auth_strategy' => getenv('AUTH_STRATEGY') ?: 'file',

    /**
     * In case of file auth strategy location of file of user record
     */
    'user_file_path' => getenv('USER_FILE_PATH') ?: __DIR__ . '/users.json',

    'smtp' => [
        'host' => getenv('MAILER_HOST') ?: 'smtp.gmail.com',
        'username' => getenv('MAILER_USERNAME') ?: '',
        'password' => getenv('MAILER_PASSWORD') ?: '',
        'encryption' => getenv('MAILER_ENCRYPTION') ?: 'tls', // or 'ssl'
        'port' => getenv('MAILER_PORT') ?: 587, // or 465 for SSL
        'debug' => 0, // PHPMailer::DEBUG_OFF — add phpmailer/phpmailer and swap this back in if you use SMTP
    ],
];

$defaultTimezone = 'UTC';
$timezone = getenv('TIMEZONE') ?: $defaultTimezone;
if (!in_array($timezone, timezone_identifiers_list())) {
    throw new \InvalidArgumentException("Invalid timezone: {$timezone}");
}
date_default_timezone_set($timezone);

if ($config['auth_strategy'] === 'file' && !is_readable($config['user_file_path'])) {
    throw new \RuntimeException("Invalid user file path: {$config['user_file_path']}");
}

return $config;
