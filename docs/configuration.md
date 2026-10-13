# Configuration and environment

## `.env`

Copy `.env.example` to `.env` for local use. Keep `.env` out of version control and never publish credentials. The exact environment variables read by configuration can vary with the installed framework version; the sample skeleton uses these names:

| Variable | Purpose | Typical development value |
|---|---|---|
| `APP_ENV` | Runtime mode used for error/debug behavior | `development` locally; `production` on a server |
| `APP_DEBUG` | Boolean debug flag used by Doctrine configuration | `true` locally; `false` in production |
| `TIMEZONE` | PHP default timezone | `Asia/Kolkata` or your application's timezone |
| `DB_HOST` | Database server host | `127.0.0.1` |
| `DB_USERNAME` | Database username | local development account |
| `DB_PASSWORD` | Database password | keep private |
| `DB_DATABASE` | Database name; when empty, sample config selects `NullDatabase` | a database created for the application |
| `DB_DRIVER` | Doctrine/DBAL driver name | `pdo_mysql` for MySQL/MariaDB |
| `AUTH_STRATEGY` | `file` or `database` authentication | `file` for a fresh demo |
| `USER_FILE_PATH` | Optional path to file-auth user data | default is `config/users.json` |
| `MAILER_HOST`, `MAILER_USERNAME`, `MAILER_PASSWORD`, `MAILER_ENCRYPTION`, `MAILER_PORT` | Sample SMTP settings | set only if mail functionality is configured |

`App\\Bootstrap` initializes `ApplicationPaths`, starts Tracy in fallback mode, loads `.env` with Dotenv, configures Tracy based on `APP_ENV`, creates a Monolog logger under `storage/framework/logs`, and builds the DI container. Do not read `.env`-dependent configuration before the environment has been loaded.

## `config/Config.php`

This is the main configuration array. In the supplied skeleton it defines:

- `db`: empty unless `DB_DATABASE` is configured; otherwise host, user, password, database and driver.
- `maintenance`: allowed IPs and bypass routes.
- `pre_controller_middlewares` and `post_controller_middlewares`.
- `definitions`: loaded from `Dependencies.php`.
- `routes`: route namespaces, defaulting to `App\\Controllers`.
- `show_current_route_info`: debug information flag.
- `auth_strategy`: file or database.
- `user_file_path`: location of the JSON user store.
- `smtp`: sample mail configuration.

The file validates the configured timezone and ensures the user JSON is readable when file authentication is active. Keep returned values as an array.

## Other configuration files

- `Dependencies.php`: explicit DI interface bindings and service providers.
- `Auth.php`: application/framework authentication-related configuration, if consumed by the installed code.
- `Security.php`: security settings consumed by `SecurityService`.
- `Migrations.php`: Doctrine Migrations configuration.
- `users.json`: demo file-auth users; protect it from public access and replace demo accounts before deployment.

The framework `ConfigManager` loads `Config.php` at the top level and other PHP config files under keys matching their filenames. Check how each file is consumed before assuming that every config file has an effect.

## Application paths

Use these helpers only after `App\\Bootstrap::boot()` has initialized `Core\\ApplicationPaths`:

```php
base_path('composer.json');
app_path('Controllers');
config_path('Config.php');
storage_path('framework/logs/app.log');
public_path('views/welcome.php');
view_path('welcome.php');
cache_path();
```

The application root is the directory containing the application's `composer.json`, `app/`, `config/` and `vendor/`. Do not use `getcwd()` to find it. In CLI scripts, initialize the application bootstrap before calling these helpers; otherwise `ApplicationPaths has not been initialized` is expected.

## Logs and cache

The skeleton writes application logs to `storage/framework/logs/app.log`. Ensure the PHP process can write there. Template/cache storage uses `storage/framework/temp/cache` by convention. Do not expose storage directories through the public web root.
