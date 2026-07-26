<?php

use Doctrine\Migrations\DependencyFactory;

require_once __DIR__ . '/vendor/autoload.php';

// Initialize the application container
$container = \App\Bootstrap::boot();

// Retrieve DependencyFactory
return $container->get(DependencyFactory::class);
