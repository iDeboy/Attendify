<?php

declare(strict_types=1);

namespace DependencyInjection;

use Closure;
use DependencyInjection\ServiceCall;
use ReflectionClass;
use ReflectionFunction;

class FactoryServiceCall extends ServiceCall {

    public function __construct(
        ServiceLifetime $lifetime,
        ReflectionClass $serviceType,
        public readonly ReflectionFunction $factory
    ) {
        parent::__construct($lifetime, $serviceType, null);
    }
}
