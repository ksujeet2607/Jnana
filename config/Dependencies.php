<?php

use App\Services\Core\AppContext;
use Jnana\Contracts\AppContextInterface;

return [
    'bindings' => [
        // Required: BaseController injects AppContextInterface, and php-di
        // never autowires an interface to a concrete class automatically —
        // it has to be told which implementation to use.
        AppContextInterface::class => \DI\autowire(AppContext::class),
    ],

    'providers' => [],
];
