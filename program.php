<?php

declare(strict_types=1);

use Abstractions\HostBuilder;
use Abstractions\Renderer;
use Abstractions\Router;
use Controllers\LoginController;
use Controllers\PruebasController;

$builder = HostBuilder::default_builder();

$builder->services
    ->add_singleton(Renderer::class, fn(): Renderer => new Renderer('App.php'))
    ->add_singleton(Router::class)
    ->add_transient(PruebasController::class)
    ->add_transient(LoginController::class)
    ;

return $builder->build();