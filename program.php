<?php

declare(strict_types=1);

use Abstractions\HostBuilder;
use Abstractions\Renderer;
use Abstractions\Router;

$builder = HostBuilder::default_builder();

$builder->services
    ->add_singleton(Renderer::class, fn(): Renderer => new Renderer('App.php'))
    ->add_singleton(Router::class)
    ;

return $builder->build();