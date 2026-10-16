<?php

declare(strict_types=1);

return [
    'salt' => '',
    'algorithm' => 'sha256',
    'csrf_exclusion_routes' => [
    ],
    'csrf_exclusion_methods' => [
        'GET',
        'HEAD',
        'OPTIONS',
    ],
    // CSRF token lifetime in seconds (2 hours by default).
    'csrf_token_lifetime' => (int) (getenv('CSRF_TOKEN_LIFETIME') ?: 7200),
    // Apply LoginRateLimitMiddleware only to login POST routes.
    'rate_limit' => [
        'login' => [
            'enabled' => filter_var(getenv('LOGIN_RATE_LIMIT_ENABLED') ?: '1', FILTER_VALIDATE_BOOLEAN),
            'max_attempts' => max(1, (int) (getenv('LOGIN_RATE_LIMIT_MAX_ATTEMPTS') ?: 5)),
            'window_seconds' => max(1, (int) (getenv('LOGIN_RATE_LIMIT_WINDOW_SECONDS') ?: 900)),
            'identifier_field' => getenv('LOGIN_IDENTIFIER_FIELD') ?: 'username',
        ],
    ],
    'hsts' => filter_var(getenv('SECURITY_HSTS') ?: '0', FILTER_VALIDATE_BOOLEAN),
    // CSP is intentionally not enabled by default because existing apps may use inline scripts.
    'headers' => [
        'X-Content-Type-Options' => 'nosniff',
        'X-Frame-Options' => 'SAMEORIGIN',
        'Referrer-Policy' => 'strict-origin-when-cross-origin',
        'Permissions-Policy' => 'camera=(), microphone=(), geolocation=()',
    ],
];
