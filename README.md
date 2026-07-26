# Jnana App

Project skeleton for the [Jnana](https://github.com/ksujeet2607/Jnana) PHP framework.

## Create a new project

```bash
composer create-project jnana/jnana my-app
cd my-app
php -S localhost:8000 router.php
```

Visit `http://localhost:8000/` — you should see the "Jnana is successfully
installed!" welcome page. No database setup required.

## What you get out of the box

- `index.php` — front controller
- `app/Bootstrap.php` — boots env, logging (Monolog), error handling (Tracy), and the DI container
- `app/Controllers/BaseController.php` + `WelcomeController.php`
- `app/Services/Core/AppContext.php` + `app/Entities/Support/User.php` — minimal
  implementations of the framework's `AppContextInterface` / `Authenticatable`
  contracts
- `config/Config.php`, `Dependencies.php`, `Security.php`, `Auth.php`,
  `Migrations.php`, `users.json` — a demo file-based login (`admin` /
  `password`) so auth works with zero database setup
- `.htaccess` (Apache) and `web.config` (IIS) rewrite rules, plus `router.php`
  for PHP's built-in dev server

## Switching to a real database

1. Set `DB_HOST` / `DB_USERNAME` / `DB_PASSWORD` / `DB_DATABASE` in `.env`
2. Set `AUTH_STRATEGY='database'` in `.env`
3. Create a `users` table matching `app/Entities/Support/User.php`
   (`id`, `username`, `password_hash`, `is_active`), or adjust the entity to
   match your schema
4. `composer require doctrine/dbal doctrine/orm` are already pulled in
   transitively via `jnana/easy`

## Adding your own routes

Add a method with a `#[Get('/path')]` / `#[Post('/path')]` attribute to any
controller under `app/Controllers` that extends `BaseController` — routes are
auto-discovered, no separate routes file to maintain.

```php
#[Get('/hello')]
public function hello()
{
    return $this->text('Hello, world!');
}
```

## License

MIT — see [LICENSE](LICENSE).
