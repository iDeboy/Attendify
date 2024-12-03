<?php

declare(strict_types=1);

namespace DependencyInjection;

use ReflectionClass;
use ReflectionFunction;

class ConstructorServiceCall extends ServiceCall {

    /** @param ServiceCall[] $parameters */
    public function __construct(
        ServiceLifetime $lifetime,
        ReflectionClass $serviceType,
        ReflectionClass $implementationType,
        public readonly ReflectionFunction $constructor,
        public readonly array $parameters = []
    ) {
        parent::__construct($lifetime, $serviceType, $implementationType);
    }
}
