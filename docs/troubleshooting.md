# Troubleshooting

## `ApplicationPaths has not been initialized`

A helper or framework component was called before application bootstrap. In the HTTP flow, `index.php` loads Composer autoload and calls `App\\Bootstrap::boot()`. In custom scripts or CLI commands, initialize the bootstrap before calling path helpers. Do not fix this by relying on the current working directory.

## Welcome page does not load

- Run `composer install` and verify `vendor/autoload.php` exists.
- Confirm `.env` exists (copy `.env.example` if needed).
- Start the built-in server from the project root with `php -S localhost:8000 router.php`.
- Check that `config/Config.php` returns a valid array and `routes` is not empty.
- Inspect `storage/framework/logs/app.log` and PHP error logs.

## `Configuration directory not found`

The application root supplied to `ApplicationPaths` is wrong or `config/` is missing. The root should contain the application's `composer.json`, `app/`, `config/`, `public/` and `vendor/`; it must not be `vendor/jnana/framework`.

## Route is not found

- Ensure the controller file is under `app/Controllers` and declares `namespace App\\Controllers`.
- Ensure the route attribute is imported from `Library\\Routes`.
- Ensure `App\\Controllers` is included in the `routes` array.
- Confirm the HTTP method and path exactly match the request.
- Confirm Apache/IIS rewrites or the PHP development router send the request to `index.php`.

## `DI\\NotFoundException` or dependency error

Confirm the class is autoloadable and all interfaces have explicit bindings in `config/Dependencies.php`. For controller dependencies, check constructor parameters and framework attribute injection. The framework cannot automatically choose an implementation for an arbitrary interface.

## Database authentication fails

Check `AUTH_STRATEGY=database`, all `DB_*` values, PDO extension availability, database connectivity, schema, entity mappings and user password hashing. The framework intentionally refuses database authentication when `NullDatabase` is active.

## File authentication fails

Check that `config/users.json` exists, is readable by PHP, contains the expected record shape, and that `USER_FILE_PATH` resolves to the intended file. Never place a publicly accessible copy of this file under a static asset directory.

## Blank page or server error

Set development mode only in a local environment, check Tracy/PHP logs and inspect `storage/framework/logs/app.log`. Do not leave detailed error display enabled in production.

## Permission errors

Grant the PHP process access to the required logs, cache and Doctrine proxy directories. Avoid using `0777` as a permanent production solution; assign correct ownership and least-privilege permissions.
