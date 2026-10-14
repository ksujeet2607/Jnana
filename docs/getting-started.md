# Getting started

## Requirements

- PHP `^8.1` (use a currently supported PHP release compatible with the dependency constraints).
- Composer 2.
- PHP extensions required by Doctrine and the selected database driver when database features are enabled.
- A web server, or PHP's built-in development server for local testing.

Check `composer.json` for the exact version constraints of this skeleton and `jnana/framework`.

## Create a project

```bash
composer create-project jnana/jnana my-app
cd my-app
php -S localhost:8000 router.php
```

Open `http://localhost:8000/`. The default welcome page should load without a database because the sample configuration uses a null database when no `DB_DATABASE` value is set.

If creating the project does not create `.env`, copy `.env.example` to `.env`. The Composer `post-create-project-cmd` script normally performs this step and creates the standard storage directories.

## Directory structure

```text
my-app/
├── app/
│   ├── Bootstrap.php
│   ├── Controllers/
│   ├── Entities/
│   │   └── Support/User.php
│   ├── Middlewares/
│   ├── Providers/
│   ├── Proxies/
│   ├── Services/
│   │   └── Core/AppContext.php
│   └── Validators/
├── config/
│   ├── Auth.php
│   ├── Config.php
│   ├── Dependencies.php
│   ├── Migrations.php
│   ├── Security.php
│   └── users.json
├── public/views/
├── storage/framework/
│   ├── logs/
│   └── temp/cache/
├── vendor/jnana/framework/  # Composer-managed framework package
├── .env
├── .env.example
├── composer.json
├── index.php
├── router.php
├── cli-config.php
└── web.config / .htaccess
```

Some directories are optional until a feature uses them. Preserve the PSR-4 namespace conventions when adding PHP classes.

## First controller

Create `app/Controllers/HelloController.php`:

```php
<?php

declare(strict_types=1);

namespace App\Controllers;

use Jnana\Routes\Get;

final class HelloController extends Foundation
{
    #[Get('/hello')]
    public function index()
    {
        return $this->text('Hello from Jnana!');
    }
}
```

Visit `/hello`. The default `config/Config.php` already registers the `App\\Controllers` namespace, so a new controller in that directory should be discovered automatically after Composer can autoload it.

## How a request starts

`index.php` loads `vendor/autoload.php`, calls `App\\Bootstrap::boot()`, resolves `Core\\AppManager` from the container, registers the AppManager singleton and runs the request. `router.php` is only a convenience router for PHP's built-in server; real Apache/IIS configuration should route application requests to `index.php` while serving existing public files directly.

## Development workflow

1. Add application code under `app/` and templates under `public/views/`.
2. Add or change configuration under `config/` and `.env`.
3. Use the framework's path helpers rather than hard-coded relative paths.
4. Run `composer dump-autoload` if you change Composer autoload mappings.
5. Check PHP syntax and application logs after changes.
