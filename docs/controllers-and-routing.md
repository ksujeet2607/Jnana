# Controllers and routing

## Controller conventions

Place controllers in `app/Controllers` with the namespace `App\\Controllers`. Extend the application's `App\\Controllers\\BaseController`, which extends the framework base controller. This lets the application add shared behavior without forking framework code.

```php
<?php

declare(strict_types=1);

namespace App\Controllers;

use Library\Routes\Get;
use Library\Routes\Post;
use Library\Routes\RouteGroup;

#[RouteGroup(prefix: '/catalog')]
final class CatalogController extends BaseController
{
    #[Get('/')]
    public function index()
    {
        return $this->render('catalog/index', ['title' => 'Catalog']);
    }

    #[Get('/{id}')]
    public function show(string $id)
    {
        return $this->text('Catalog item: ' . $id);
    }

    #[Post('/')]
    public function store()
    {
        // Validate request input and persist through an application service.
        return $this->redirect('/catalog');
    }
}
```

This creates `/catalog/`, `/catalog/{id}` and POST `/catalog/`. Confirm whether you want trailing-slash canonicalization in your app and use one convention consistently.

## Supported route attributes

- `#[Get('/path')]` — GET route; the attribute is repeatable.
- `#[Post('/path')]` — POST route.
- `#[RouteGroup(prefix: '/prefix', middlewares: [...])]` — class-level prefix and middleware.
- `#[Middleware([...])]` — controller or method middleware (import `Library\\Middleware\\Middleware`).

The base `Route` attribute stores request method, route path and optional middleware. Route discovery scans namespaces configured in `config/Config.php`.

## Responses

Prefer framework controller helpers:

```php
return $this->render('catalog/index', ['items' => $items]);
return $this->json(['items' => $items]);
return $this->text('Created', 201);
return $this->redirect('/catalog');
```

Validate user input and authorization before mutating data. Do not return raw exception messages to users. Escape dynamic values in PHP views.

## Route parameters

Route parameters are passed positionally to the controller method by the router. Match the number and order of method arguments to route placeholders. Test route matching with the HTTP method that the browser/client will actually use.

## Views

Store PHP view files under `public/views`. For `render('catalog/index')`, create `public/views/catalog/index.php` according to the installed renderer's template naming convention. Pass view data explicitly as an associative array.

## Adding another controller namespace

Add its namespace to the `routes` array in `config/Config.php` and ensure `Core\\ApplicationPaths` knows how to map that namespace prefix to a directory. The default mapping is `App\\` to `app/`; custom namespace prefixes require an explicit mapping when constructing `ApplicationPaths`.

## Common mistakes

- File path and namespace disagree (`app/Controllers/X.php` must declare `App\\Controllers`).
- Controller is not autoloadable through Composer.
- Route namespace was not added to `config/Config.php`.
- Attribute import is missing or uses the wrong namespace.
- Middleware does not implement the framework middleware contract.
- A view name is confused with a URL or filesystem absolute path.
