<?php

declare(strict_types=1);

/**
 * Central authorization policy.
 *
 * Map application role codes to permission names. Permissions not explicitly
 * granted here or in the authenticated user's `permissions` array are denied.
 * Avoid wildcard grants unless the role is intentionally a full administrator.
 */
return [
    'role_permissions' => [
        // Example:
        // 'admin' => ['users.view', 'users.create', 'users.update', 'users.delete'],
        // 'manager' => ['reports.view', 'users.view'],
        // 'super_admin' => ['*'],
    ],
];
