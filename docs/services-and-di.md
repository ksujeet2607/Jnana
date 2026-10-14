# Services, dependency injection, and application context

## Keep business logic out of controllers

Controllers should coordinate HTTP input/output. Put reusable business logic in classes under `app/Services`, and inject those services into controllers through PHP-DI. This makes logic easier to test and prevents controllers from becoming tightly coupled to HTTP requests.

A simple service:

```php
<?php

declare(strict_types=1);

namespace App\Services;

final class GreetingService
{
    public function greeting(string $name): string
    {
        return 'Hello, ' . $name . '!';
    }
}
```

A controller can type-hint `GreetingService` in its constructor if the installed container can autowire it. If constructor injection does not fit a framework-provided controller lifecycle, register a binding explicitly in `config/Dependencies.php`.

## Manual bindings

The skeleton's `config/Dependencies.php` returns a structure with `bindings` and `providers` keys:

```php
<?php

use App\Services\Core\AppContext;
use Jnana\Contracts\AppContextInterface;

return [
    'bindings' => [
        AppContextInterface::class => DI\autowire(AppContext::class),
    ],
    'providers' => [],
];
```

An interface must be bound to a concrete implementation. PHP-DI cannot infer the implementation of an arbitrary interface on its own.

## Service providers

Create providers under `app/Providers`, implement `Library\\Contracts\\ServiceProviderInterface`, and register custom providers in `definitions['providers']` if needed. The current container factory also scans `app/Providers` for classes. Provider registration receives a `DI\\ContainerBuilder`; follow the exact interface signature in the installed framework source.

Keep providers focused on service registration. Avoid database queries or request-specific behavior during container construction.

## Validators

Place validators under `app/Validators` with the matching `App\\Validators` namespace. The container factory discovers classes in this directory and registers them for autowiring. Validation should enforce server-side business rules; front-end validation is only a usability aid.

## Application context and authenticated users

The framework intentionally does not depend on an application-specific user entity. The skeleton provides:

- `App\\Services\\Core\\AppContext`, implementing `Library\\Contracts\\AppContextInterface`.
- `App\\Entities\\Support\\User`, implementing `Library\\Contracts\\Authenticatable`.

The base controller injects `AppContextInterface`; `getCurrentUser()` delegates to its `user()` method. When replacing the demo user model, implement the contract methods expected by the interface and update the binding in `Dependencies.php`.

## Custom middleware

Place application middleware in `app/Middlewares`, namespace it under `App\\Middlewares`, and implement `Library\\Middleware\\MiddlewareInterface`. Its `process(Request $request, Response $response, callable $next): Response` method must return a framework `Response`. Attach middleware to a controller or action using the framework middleware attribute, or configure it globally in `Config.php`.

## Path and service lifecycle

The framework's `ApplicationPaths` is initialized by `App\\Bootstrap::boot()`. Do not resolve path helpers from a file that executes before bootstrap. Do not manually instantiate framework services with guessed relative paths; inject dependencies or use the central path service.
