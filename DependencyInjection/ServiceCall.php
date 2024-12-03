<?php

namespace DependencyInjection;

use ReflectionClass;

abstract class ServiceCall {

    public ?object $value = null;

    public function __construct(
        public readonly ServiceLifetime $lifetime,
        public readonly ReflectionClass $serviceType,
        public readonly ?ReflectionClass $implementationType
    ) {
    }

}
// https://source.dot.net/#Microsoft.Extensions.DependencyInjection/ServiceLookup/ResultCache.cs,c7759f62aefb1f46

