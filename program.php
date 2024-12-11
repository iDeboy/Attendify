<?php

declare(strict_types=1);

use Abstractions\DbContext;
use Abstractions\HostBuilder;
use Abstractions\Renderer;
use Abstractions\Router;
use Controllers\LoginController;
use Controllers\PruebasController;
use Controllers\RegistroController;

$builder = HostBuilder::default_builder();

$builder->services
    ->add_singleton(Renderer::class, fn(): Renderer => new Renderer('App.php'))
    ->add_singleton(Router::class)
    ->add_transient(DbContext::class, function (): DbContext {

        // TODO: credenciales en .env
        if (strcmp($_SERVER['SERVER_SOFTWARE'], 'LiteSpeed')  === 0)
            return new DbContext('auth-db1212.hstgr.io', 'u117281852_w24021001', 'Honorio2401$', 'u117281852_w24021001'); 
        else
            return new DbContext('localhost', 'root', '', 'asistencia');
    })
    ->add_transient(PruebasController::class)
    ->add_transient(LoginController::class)
    ->add_transient(RegistroController::class)
;

return $builder->build();
