<?php

declare(strict_types=1);

return [
    'enabled' => filter_var(getenv('SECURE_UPLOADS_ENABLED') ?: '1', FILTER_VALIDATE_BOOL),
    // Relative to storage/, never public/.
    'directory' => 'uploads',
    'max_bytes' => max(1, (int) (getenv('UPLOAD_MAX_BYTES') ?: 5242880)),
    // MIME is detected from file contents; client-supplied Content-Type is not trusted.
    'allowed_mime_types' => [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'application/pdf' => 'pdf',
        'text/plain' => 'txt',
    ],
];
