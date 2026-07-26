<?php
declare(strict_types=1);

session_start();

require __DIR__ . '/vendor/autoload.php';

try {

    // Boot the application
    $container = App\Bootstrap::boot();
    $app = $container->get(Core\AppManager::class);

} catch (\DI\DependencyException $e) {

    throw new RuntimeException('AppManager class is not properly defined in the container.');

} catch (\DI\NotFoundException $e) {

    throw new RuntimeException('AppManager class not found.');
}

Core\AppManager::setInstance($app);

// Run the application
$app->run();
