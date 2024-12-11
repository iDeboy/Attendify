<?php

declare(strict_types=1);

use Abstractions\DbContext;
use Abstractions\HostBuilder;
use Abstractions\Renderer;
use Abstractions\Router;
use Controllers\LoginController;
use Controllers\PruebasController;
use Controllers\RegistroController;
use Dotenv\Dotenv;

$builder = HostBuilder::default_builder();

Dotenv::createImmutable(__DIR__)->load();

$builder->services
    ->add_singleton(Renderer::class, fn(): Renderer => new Renderer('App.php'))
    ->add_singleton(Router::class)
    ->add_transient(DbContext::class, function (): DbContext {

        $hostname = $_ENV['DBHOST'];
        $username = $_ENV['DBUSERNAME'];
        $password = $_ENV['DBPASSWORD'];
        $database = $_ENV['DBNAME'];

        return new DbContext($hostname, $username, $password, $database);
    })
    ->add_transient(PruebasController::class)
    ->add_transient(LoginController::class)
    ->add_transient(RegistroController::class)
;

return $builder->build();
