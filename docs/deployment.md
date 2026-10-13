# Deployment

## Production prerequisites

- Install dependencies from `composer.lock` using `composer install --no-dev --optimize-autoloader` when a lock file is committed and compatible with the target environment.
- Set `.env` or the server environment variables securely; do not upload secrets into a public directory.
- Set `APP_ENV=production` and `APP_DEBUG=false` where applicable.
- Configure the database and authentication strategy before enabling data-dependent features.
- Ensure `storage/framework/logs`, `storage/framework/temp/cache`, and `app/Proxies` are writable by the appropriate PHP process user.
- Use HTTPS and secure session-cookie settings at the web server/PHP layer.

## Web root and entry points

The supplied project has `index.php` at the project root and also includes `public/` for views/assets. Configure the web server so application requests are sent to `index.php`, while sensitive files (`.env`, `composer.json`, `config/`, `storage/`, `vendor/`) are not directly downloadable. If the deployment supports configuring a document root, prefer a dedicated public web root and ensure the routing configuration matches the actual entry point. Do not assume that putting views under `public/views` automatically makes the project root safe as a document root.

## Apache

The project includes `.htaccess` rewrite rules. Confirm `mod_rewrite` is enabled and `AllowOverride` permits the rules. Existing static files should be served directly; non-file routes should reach the front controller. Test both a static asset and a controller route after deployment.

## IIS

The project includes `web.config`. Confirm URL Rewrite is installed and the rule forwards application paths to the intended front controller. Check IIS permissions for log/cache directories and verify that `.env`, configuration files and source files are not served.

## PHP built-in server

For local development only:

```bash
php -S localhost:8000 router.php
```

The built-in server is not a production server. The router script checks existing files and forwards other requests to `index.php`.

## Deployment smoke test

- `/` returns the welcome page or intended home page.
- A known GET route resolves and an unknown route returns a controlled 404.
- A POST route validates CSRF and input.
- Authentication and authorization are enforced.
- Database operations work when enabled.
- Logs are written without exposing secrets.
- `.env`, `config/`, `storage/`, `vendor/` and internal source files cannot be downloaded.
- Error output is appropriate for production.
