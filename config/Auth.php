<?php

declare(strict_types=1);

/**
 * Auth configuration for database strategy.
 * Used only when auth_strategy is 'database'
 */
return [
    'table' => 'users',
    'usernameField' => 'username',
    'emailField' => 'email',
    'passwordField' => 'password_hash',
    'statusField' => 'is_active',
    'activeStatusValue' => true,
];
