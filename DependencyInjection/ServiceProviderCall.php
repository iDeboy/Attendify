<?php

namespace DependencyInjection;

use ReflectionClass;

class ServiceProviderCall extends ServiceCall {

    public function __construct() {
        parent::__construct(ServiceLifetime::Singleton, new ReflectionClass(IServiceProvider::class), new ReflectionClass(ServiceProvider::class));
    }
}
