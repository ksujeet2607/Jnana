[33mtag v1.0.3[m
Tagger: Sujeet <kahar26sujeet@gmail.com>
Date:   Wed Oct 14 18:48:13 2026 +0530

Release v1.0.3

[33mcommit 3fa3921a49c571c8788ca564a0c30a17c11ea9de[m[33m ([m[1;33mtag: [m[1;33mv1.0.3[m[33m)[m
Author: Sujeet <kahar26sujeet@gmail.com>
Date:   Tue Oct 13 12:43:44 2026 +0530

    Updated release documents v1.0.2

[1mdiff --git a/README.md b/README.md[m
[1mindex 73043c7..f9e04cb 100644[m
[1m--- a/README.md[m
[1m+++ b/README.md[m
[36m@@ -1,56 +1,17 @@[m
[31m-# Jnana App[m
[32m+[m[32m# Jnana Application Documentation[m
 [m
[31m-Project skeleton for the [Jnana](https://github.com/ksujeet2607/Jnana) PHP framework.[m
[32m+[m[32mThis guide explains how to build and operate an application created from the `jnana/jnana` project skeleton. It complements the [framework documentation](https://github.com/ksujeet2607/Jnana) and describes application-owned files and conventions.[m
 [m
[31m-## Create a new project[m
[32m+[m[32m## Guides[m
 [m
[31m-```bash[m
[31m-composer create-project jnana/jnana my-app[m
[31m-cd my-app[m
[31m-php -S localhost:8000 router.php[m
[31m-```[m
[32m+[m[32m- [Getting started](getting-started.md) — installation, local server, and project structure.[m
[32m+[m[32m- [Configuration and environment](configuration.md) — `.env`, config files, paths, logging and runtime modes.[m
[32m+[m[32m- [Controllers and routing](controllers-and-routing.md) — adding pages and API endpoints with attributes.[m
[32m+[m[32m- [Services, DI and application context](services-and-di.md) — services, providers, bindings and user context.[m
[32m+[m[32m- [Database and authentication](database-and-authentication.md) — Doctrine setup, file/database authentication and security.[m
[32m+[m[32m- [Deployment](deployment.md) — Apache/IIS/PHP server configuration and production checklist.[m
[32m+[m[32m- [Troubleshooting](troubleshooting.md) — common boot, routing, path and database errors.[m
 [m
[31m-Visit `http://localhost:8000/` — you should see the "Jnana is successfully[m
[31m-installed!" welcome page. No database setup required.[m
[32m+[m[32m## Core rule[m
 [m
[31m-## What you get out of the box[m
[31m-[m
[31m-- `index.php` — front controller[m
[31m-- `app/Bootstrap.php` — boots env, logging (Monolog), error handling (Tracy), and the DI container[m
[31m-- `app/Controllers/BaseController.php` + `WelcomeController.php`[m
[31m-- `app/Services/Core/AppContext.php` + `app/Entities/Support/User.php` — minimal[m
[31m-  implementations of the framework's `AppContextInterface` / `Authenticatable`[m
[31m-  contracts[m
[31m-- `config/Config.php`, `Dependencies.php`, `Security.php`, `Auth.php`,[m
[31m-  `Migrations.php`, `users.json` — a demo file-based login (`admin` /[m
[31m-  `password`) so auth works with zero database setup[m
[31m-- `.htaccess` (Apache) and `web.config` (IIS) rewrite rules, plus `router.php`[m
[31m-  for PHP's built-in dev server[m
[31m-[m
[31m-## Switching to a real database[m
[31m-[m
[31m-1. Set `DB_HOST` / `DB_USERNAME` / `DB_PASSWORD` / `DB_DATABASE` in `.env`[m
[31m-2. Set `AUTH_STRATEGY='database'` in `.env`[m
[31m-3. Create a `users` table matching `app/Entities/Support/User.php`[m
[31m-   (`id`, `username`, `password_hash`, `is_active`), or adjust the entity to[m
[31m-   match your schema[m
[31m-4. `composer require doctrine/dbal doctrine/orm` are already pulled in[m
[31m-   transitively via `jnana/easy`[m
[31m-[m
[31m-## Adding your own routes[m
[31m-[m
[31m-Add a method with a `#[Get('/path')]` / `#[Post('/path')]` attribute to any[m
[31m-controller under `app/Controllers` that extends `BaseController` — routes are[m
[31m-auto-discovered, no separate routes file to maintain.[m
[31m-[m
[31m-```php[m
[31m-#[Get('/hello')][m
[31m-public function hello()[m
[31m-{[m
[31m-    return $this->text('Hello, world!');[m
[31m-}[m
[31m-```[m
[31m-[m
[31m-## License[m
[31m-[m
[31m-MIT — see [LICENSE](LICENSE).[m
[32m+[m[32mApplication code belongs in this repository; reusable framework code belongs in the Composer package `jnana/framework`. Do not edit `vendor/jnana/framework` as the normal way to add business behavior. Add application services, controllers, entities, middleware or bindings instead. Framework bugs should be fixed in the framework repository and released as a new package version.[m
[1mdiff --git a/composer.json b/composer.json[m
[1mindex a802dd8..4914a1c 100644[m
[1m--- a/composer.json[m
[1m+++ b/composer.json[m
[36m@@ -5,7 +5,7 @@[m
     "license": "MIT",[m
     "require": {[m
         "php": "^8.1",[m
[31m-        "jnana/framework": "^1.0.1",[m
[32m+[m[32m        "jnana/framework": "^1.0",[m
         "vlucas/phpdotenv": "^5.6",[m
         "monolog/monolog": "^3.4",[m
         "doctrine/migrations": "^3.7"[m
[1mdiff --git a/docs/README.md b/docs/README.md[m
[1mnew file mode 100644[m
[1mindex 0000000..f9e04cb[m
[1m--- /dev/null[m
[1m+++ b/docs/README.md[m
[36m@@ -0,0 +1,17 @@[m
[32m+[m[32m# Jnana Application Documentation[m
[32m+[m
[32m+[m[32mThis guide explains how to build and operate an application created from the `jnana/jnana` project skeleton. It complements the [framework documentation](https://github.com/ksujeet2607/Jnana) and describes application-owned files and conventions.[m
[32m+[m
[32m+[m[32m## Guides[m
[32m+[m
[32m+[m[32m- [Getting started](getting-started.md) — installation, local server, and project structure.[m
[32m+[m[32m- [Configuration and environment](configuration.md) — `.env`, config files, paths, logging and runtime modes.[m
[32m+[m[32m- [Controllers and routing](controllers-and-routing.md) — adding pages and API endpoints with attributes.[m
[32m+[m[32m- [Services, DI and application context](services-and-di.md) — services, providers, bindings and user context.[m
[32m+[m[32m- [Database and authentication](database-and-authentication.md) — Doctrine setup, file/database authentication and security.[m
[32m+[m[32m- [Deployment](deployment.md) — Apache/IIS/PHP server configuration and production checklist.[m
[32m+[m[32m- [Troubleshooting](troubleshooting.md) — common boot, routing, path and database errors.[m
[32m+[m
[32m+[m[32m## Core rule[m
[32m+[m
[32m+[m[32mApplication code belongs in this repository; reusable framework code belongs in the Composer package `jnana/framework`. Do not edit `vendor/jnana/framework` as the normal way to add business behavior. Add application services, controllers, entities, middleware or bindings instead. Framework bugs should be fixed in the framework repository and released as a new package version.[m
[1mdiff --git a/docs/configuration.md b/docs/configuration.md[m
[1mnew file mode 100644[m
[1mindex 0000000..d605259[m
[1m--- /dev/null[m
[1m+++ b/docs/configuration.md[m
[36m@@ -0,0 +1,67 @@[m
[32m+[m[32m# Configuration and environment[m
[32m+[m
[32m+[m[32m## `.env`[m
[32m+[m
[32m+[m[32mCopy `.env.example` to `.env` for local use. Keep `.env` out of version control and never publish credentials. The exact environment variables read by configuration can vary with the installed framework version; the sample skeleton uses these names:[m
[32m+[m
[32m+[m[32m| Variable | Purpose | Typical development value |[m
[32m+[m[32m|---|---|---|[m
[32m+[m[32m| `APP_ENV` | Runtime mode used for error/debug behavior | `development` locally; `production` on a server |[m
[32m+[m[32m| `APP_DEBUG` | Boolean debug flag used by Doctrine configuration | `true` locally; `false` in production |[m
[32m+[m[32m| `TIMEZONE` | PHP default timezone | `Asia/Kolkata` or your application's timezone |[m
[32m+[m[32m| `DB_HOST` | Database server host | `127.0.0.1` |[m
[32m+[m[32m| `DB_USERNAME` | Database username | local development account |[m
[32m+[m[32m| `DB_PASSWORD` | Database password | keep private |[m
[32m+[m[32m| `DB_DATABASE` | Database name; when empty, sample config selects `NullDatabase` | a database created for the application |[m
[32m+[m[32m| `DB_DRIVER` | Doctrine/DBAL driver name | `pdo_mysql` for MySQL/MariaDB |[m
[32m+[m[32m| `AUTH_STRATEGY` | `file` or `database` authentication | `file` for a fresh demo |[m
[32m+[m[32m| `USER_FILE_PATH` | Optional path to file-auth user data | default is `config/users.json` |[m
[32m+[m[32m| `MAILER_HOST`, `MAILER_USERNAME`, `MAILER_PASSWORD`, `MAILER_ENCRYPTION`, `MAILER_PORT` | Sample SMTP settings | set only if mail functionality is configured |[m
[32m+[m
[32m+[m[32m`App\\Bootstrap` initializes `ApplicationPaths`, starts Tracy in fallback mode, loads `.env` with Dotenv, configures Tracy based on `APP_ENV`, creates a Monolog logger under `storage/framework/logs`, and builds the DI container. Do not read `.env`-dependent configuration before the environment has been loaded.[m
[32m+[m
[32m+[m[32m## `config/Config.php`[m
[32m+[m
[32m+[m[32mThis is the main configuration array. In the supplied skeleton it defines:[m
[32m+[m
[32m+[m[32m- `db`: empty unless `DB_DATABASE` is configured; otherwise host, user, password, database and driver.[m
[32m+[m[32m- `maintenance`: allowed IPs and bypass routes.[m
[32m+[m[32m- `pre_controller_middlewares` and `post_controller_middlewares`.[m
[32m+[m[32m- `definitions`: loaded from `Dependencies.php`.[m
[32m+[m[32m- `routes`: route namespaces, defaulting to `App\\Controllers`.[m
[32m+[m[32m- `show_current_route_info`: debug information flag.[m
[32m+[m[32m- `auth_strategy`: file or database.[m
[32m+[m[32m- `user_file_path`: location of the JSON user store.[m
[32m+[m[32m- `smtp`: sample mail configuration.[m
[32m+[m
[32m+[m[32mThe file validates the configured timezone and ensures the user JSON is readable when file authentication is active. Keep returned values as an array.[m
[32m+[m
[32m+[m[32m## Other configuration files[m
[32m+[m
[32m+[m[32m- `Dependencies.php`: explicit DI interface bindings and service providers.[m
[32m+[m[32m- `Auth.php`: application/framework authentication-related configuration, if consumed by the installed code.[m
[32m+[m[32m- `Security.php`: security settings consumed by `SecurityService`.[m
[32m+[m[32m- `Migrations.php`: Doctrine Migrations configuration.[m
[32m+[m[32m- `users.json`: demo file-auth users; protect it from public access and replace demo accounts before deployment.[m
[32m+[m
[32m+[m[32mThe framework `ConfigManager` loads `Config.php` at the top level and other PHP config files under keys matching their filenames. Check how each file is consumed before assuming that every config file has an effect.[m
[32m+[m
[32m+[m[32m## Application paths[m
[32m+[m
[32m+[m[32mUse these helpers only after `App\\Bootstrap::boot()` has initialized `Core\\ApplicationPaths`:[m
[32m+[m
[32m+[m[32m```php[m
[32m+[m[32mbase_path('composer.json');[m
[32m+[m[32mapp_path('Controllers');[m
[32m+[m[32mconfig_path('Config.php');[m
[32m+[m[32mstorage_path('framework/logs/app.log');[m
[32m+[m[32mpublic_path('views/welcome.php');[m
[32m+[m[32mview_path('welcome.php');[m
[32m+[m[32mcache_path();[m
[32m+[m[32m```[m
[32m+[m
[32m+[m[32mThe application root is the directory containing the application's `composer.json`, `app/`, `config/` and `vendor/`. Do not use `getcwd()` to find it. In CLI scripts, initialize the application bootstrap before calling these helpers; otherwise `ApplicationPaths has not been initialized` is expected.[m
[32m+[m
[32m+[m[32m## Logs and cache[m
[32m+[m
[32m+[m[32mThe skeleton writes application logs to `storage/framework/logs/app.log`. Ensure the PHP process can write there. Template/cache storage uses `storage/framework/temp/cache` by convention. Do not expose storage directories through the public web root.[m
[1mdiff --git a/docs/controllers-and-routing.md b/docs/controllers-and-routing.md[m
[1mnew file mode 100644[m
[1mindex 0000000..fce48d1[m
[1m--- /dev/null[m
[1m+++ b/docs/controllers-and-routing.md[m
[36m@@ -0,0 +1,85 @@[m
[32m+[m[32m# Controllers and routing[m
[32m+[m
[32m+[m[32m## Controller conventions[m
[32m+[m
[32m+[m[32mPlace controllers in `app/Controllers` with the namespace `App\\Controllers`. Extend the application's `App\\Controllers\\BaseController`, which extends the framework base controller. This lets the application add shared behavior without forking framework code.[m
[32m+[m
[32m+[m[32m```php[m
[32m+[m[32m<?php[m
[32m+[m
[32m+[m[32mdeclare(strict_types=1);[m
[32m+[m
[32m+[m[32mnamespace App\Controllers;[m
[32m+[m
[32m+[m[32muse Library\Routes\Get;[m
[32m+[m[32muse Library\Routes\Post;[m
[32m+[m[32muse Library\Routes\RouteGroup;[m
[32m+[m
[32m+[m[32m#[RouteGroup(prefix: '/catalog')][m
[32m+[m[32mfinal class CatalogController extends BaseController[m
[32m+[m[32m{[m
[32m+[m[32m    #[Get('/')][m
[32m+[m[32m    public function index()[m
[32m+[m[32m    {[m
[32m+[m[32m        return $this->render('catalog/index', ['title' => 'Catalog']);[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    #[Get('/{id}')][m
[32m+[m[32m    public function show(string $id)[m
[32m+[m[32m    {[m
[32m+[m[32m        return $this->text('Catalog item: ' . $id);[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    #[Post('/')][m
[32m+[m[32m    public function store()[m
[32m+[m[32m    {[m
[32m+[m[32m        // Validate request input and persist through an application service.[m
[32m+[m[32m        return $this->redirect('/catalog');[m
[32m+[m[32m    }[m
[32m+[m[32m}[m
[32m+[m[32m```[m
[32m+[m
[32m+[m[32mThis creates `/catalog/`, `/catalog/{id}` and POST `/catalog/`. Confirm whether you want trailing-slash canonicalization in your app and use one convention consistently.[m
[32m+[m
[32m+[m[32m## Supported route attributes[m
[32m+[m
[32m+[m[32m- `#[Get('/path')]` — GET route; the attribute is repeatable.[m
[32m+[m[32m- `#[Post('/path')]` — POST route.[m
[32m+[m[32m- `#[RouteGroup(prefix: '/prefix', middlewares: [...])]` — class-level prefix and middleware.[m
[32m+[m[32m- `#[Middleware([...])]` — controller or method middleware (import `Library\\Middleware\\Middleware`).[m
[32m+[m
[32m+[m[32mThe base `Route` attribute stores request method, route path and optional middleware. Route discovery scans namespaces configured in `config/Config.php`.[m
[32m+[m
[32m+[m[32m## Responses[m
[32m+[m
[32m+[m[32mPrefer framework controller helpers:[m
[32m+[m
[32m+[m[32m```php[m
[32m+[m[32mreturn $this->render('catalog/index', ['items' => $items]);[m
[32m+[m[32mreturn $this->json(['items' => $items]);[m
[32m+[m[32mreturn $this->text('Created', 201);[m
[32m+[m[32mreturn $this->redirect('/catalog');[m
[32m+[m[32m```[m
[32m+[m
[32m+[m[32mValidate user input and authorization before mutating data. Do not return raw exception messages to users. Escape dynamic values in PHP views.[m
[32m+[m
[32m+[m[32m## Route parameters[m
[32m+[m
[32m+[m[32mRoute parameters are passed positionally to the controller method by the router. Match the number and order of method arguments to route placeholders. Test route matching with the HTTP method that the browser/client will actually use.[m
[32m+[m
[32m+[m[32m## Views[m
[32m+[m
[32m+[m[32mStore PHP view files under `public/views`. For `render('catalog/index')`, create `public/views/catalog/index.php` according to the installed renderer's template naming convention. Pass view data explicitly as an associative array.[m
[32m+[m
[32m+[m[32m## Adding another controller namespace[m
[32m+[m
[32m+[m[32mAdd its namespace to the `routes` array in `config/Config.php` and ensure `Core\\ApplicationPaths` knows how to map that namespace prefix to a directory. The default mapping is `App\\` to `app/`; custom namespace prefixes require an explicit mapping when constructing `ApplicationPaths`.[m
[32m+[m
[32m+[m[32m## Common mistakes[m
[32m+[m
[32m+[m[32m- File path and namespace disagree (`app/Controllers/X.php` must declare `App\\Controllers`