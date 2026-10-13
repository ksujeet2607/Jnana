# Database and authentication

## Default no-database mode

A fresh skeleton is intended to show the welcome page without a database. If `DB_DATABASE` is empty, the sample config returns an empty `db` configuration and the container can use `NullDatabase`/`NullEntityManager`. This is not suitable for features that need persistent data.

## Configure a database

1. Create a database and a least-privileged database account.
2. Set `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, `DB_DATABASE` and `DB_DRIVER` in `.env`.
3. Set `DB_DRIVER` to a Doctrine DBAL driver appropriate for the database (for example `pdo_mysql` for MySQL/MariaDB).
4. Confirm PHP has the corresponding PDO extension installed.
5. Create the schema required by the entities in `app/Entities`.
6. Make sure `app/Proxies` exists and is writable by PHP.
7. Test a read/write operation and review `storage/framework/logs/app.log`.

The framework configures Doctrine attribute metadata from `app/Entities`. Map entities using Doctrine ORM attributes and keep the PSR-4 namespace consistent with the directory. Check the installed Doctrine version before using ORM APIs from newer documentation.

## Authentication strategy

The sample config supports:

- `AUTH_STRATEGY=file`: uses the JSON file referenced by `USER_FILE_PATH`, defaulting to `config/users.json`.
- `AUTH_STRATEGY=database`: uses the configured database and database authentication strategy.

The demo file-based login is for initial evaluation only. Replace demo users/passwords before deployment and verify that `config/users.json` cannot be requested over HTTP. Password values should be secure hashes, not plaintext.

## Moving to database authentication

1. Configure the database as above.
2. Create/adjust the user table to match `App\\Entities\\Support\\User` and `DatabaseAuthStrategy` expectations.
3. Ensure the entity implements `Library\\Contracts\\Authenticatable`.
4. Set `AUTH_STRATEGY=database`.
5. Test successful login, invalid credentials, inactive users, logout and protected routes.
6. Do not switch strategies before the database is ready; the container intentionally rejects database auth with `NullDatabase`.

## Guards and access control

Use the guard/authorization facilities provided by the installed framework for server-side checks. Authentication establishes who the user is; authorization establishes what they can do. Protect each sensitive controller action or service operation, including direct requests that bypass UI navigation.

## Doctrine migrations

The skeleton includes `config/Migrations.php` and a `cli-config.php` integration point. The bootstrap contains a migration dependency-factory initializer, but verify that it is wired into the CLI lifecycle before relying on migration commands in this checkout. Follow the installed Doctrine Migrations version's configuration format and run migrations against a backup or disposable database first.

## Security notes

- Never commit production credentials.
- Use CSRF tokens for state-changing browser requests; keep the default CSRF middleware enabled unless the request is protected by a deliberately designed alternative.
- Validate all request data server-side and use parameterized queries.
- Do not log credentials, authorization headers, session identifiers or CSRF tokens.
- Use production error settings and restrict access to logs/config/storage directories.
