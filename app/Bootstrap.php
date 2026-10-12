<?php

declare(strict_types=1);

namespace App;

use Core\ConfigManager;
use Core\ContainerFactory;
use DI\Container;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Dotenv\Dotenv;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Tracy\Debugger;

class Bootstrap
{
    /**
     * Bootstraps the application and initializes required components.
     *
     * @throws \Exception
     */
    public static function boot(): Container
    {
        $appDir = dirname(__DIR__);

        // Resolve the application root once; framework code must not infer it from __DIR__ or getcwd().
        $paths = new \Core\ApplicationPaths($appDir);

        // Step 1: Initialize Tracy in safe fallback mode
        self::initializeDebugger($appDir, fallback: true);

        // Step 2: Load .env
        self::loadEnvironment($appDir);

        // Step 3: Reconfigure Tracy based on APP_ENV
        self::initializeDebugger($appDir);

        // Step 4: Logger & container
        $logger = self::initializeLogger($appDir);
        $container = ContainerFactory::create(new ConfigManager($paths->applicationRoot()), $logger);

        return $container;
    }

    /**
     * Initializes the Tracy Debugger.
     */
    private static function initializeDebugger(string $appDir, bool $fallback = false): void
    {
        $logDir = $appDir . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }
        // Fallback: enable safely for early errors
        if ($fallback) {
            Debugger::enable(Debugger::Production);
            Debugger::$showBar = false;
            Debugger::$logDirectory = $logDir;
            return;
        }

        // After .env is loaded
        $env = getenv('APP_ENV') ?: 'production';

        $mode = strtolower($env) === 'development'
            ? Debugger::Development
            : Debugger::Production;

        Debugger::enable($mode);
        Debugger::$logDirectory = $logDir;
    }

    /**
     * Loads environment variables from the .env file.
     */
    private static function loadEnvironment(string $appDir): void
    {
        $dotenv = Dotenv::createUnsafeImmutable($appDir);
        $dotenv->load();
    }

    /**
     * Creates and configures a Monolog logger instance.
     */
    private static function initializeLogger(string $appDir): Logger
    {
        $logger = new Logger('application');
        $logFilePath = $appDir . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'app.log';
        $streamHandler = new StreamHandler($logFilePath, \Monolog\Level::Debug, true, 0644, true, 'a');
        $logger->pushHandler($streamHandler);
        return $logger;
    }

    /**
     * Configures Doctrine Migrations DependencyFactory.
     */
    private static function initializeDoctrineMigrations(Container $container, string $appDir): void
    {
        $container->set(DependencyFactory::class, function () use ($container, $appDir) {
            $config = new PhpFile($appDir . '/config/Migrations.php');
            $entityManager = $container->get(EntityManagerInterface::class);

            return DependencyFactory::fromEntityManager(
                $config,
                new ExistingEntityManager($entityManager)
            );
        });
    }
}
