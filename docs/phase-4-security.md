# Phase 4 security updates

## Correlation IDs and error handling

Every request receives a server-generated 32-character hexadecimal correlation ID. It is returned as `X-Correlation-ID`, included in request/error logs, and included in generic 500 responses. Do not use the ID as an authorization token. In production, clients receive a generic error message; exception details remain in server logs.

## Security audit events

Use `Jnana\Security\SecurityAuditLogger` for security-relevant events. It redacts fields whose names contain password, secret, token, authorization, cookie, session, credential, or API key. The logger writes structured events through the configured PSR logger. Authorization denials, CSRF validation failures, upload accept/reject, and unhandled request exceptions are recorded. Never log raw request bodies or credentials.

## Secure uploads

`Jnana\Security\SecureFileUploadService` stores uploads under `storage/uploads/{category}` and returns a relative path, generated filename, detected MIME type, byte size, and sanitized original name. The default allowlist is JPEG, PNG, PDF, and plain text, with a 5 MiB limit. MIME type is determined with `finfo`, not the browser-provided content type or filename extension. Files receive random names and are stored outside the public document root.

Example service usage in an authenticated controller:

```php
$file = $request->getFile('document');
if ($file === null) {
    throw new \RuntimeException('Please choose a file.');
}

$stored = $container->get(\Jnana\Security\SecureFileUploadService::class)
    ->store($file, 'documents', $request);
// Persist $stored['path'] and metadata in the database.
// Serve files through an authorized controller; do not expose storage paths.
```

The PHP `fileinfo` extension must be enabled. Configure PHP/web-server upload limits (`upload_max_filesize`, `post_max_size`) consistently with `UPLOAD_MAX_BYTES`. The service should be called only after route authentication/authorization and CSRF checks. Content scanning and image re-encoding are additional deployment-specific controls for applications accepting high-risk files.
