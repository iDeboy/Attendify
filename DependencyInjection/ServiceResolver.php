<?php

declare(strict_types=1);

namespace DependencyInjection;

use OutOfRangeException;

class ServiceResolver {

    public static function resolve(ServiceCall $serviceCall, IServiceProvider $provider): object {

        if ($serviceCall->value !== null) return $serviceCall->value;

        return static::visit_service_call($serviceCall, $provider);
    }

    private static function visit_service_call(ServiceCall $serviceCall, IServiceProvider $provider): ?object {

        switch ($serviceCall->lifetime) {
            case ServiceLifetime::Singleton:
                return static::visit_singleton($serviceCall, $provider);
            case ServiceLifetime::Transient:
                return static::visit_transient($serviceCall, $provider);
            default:
                throw new OutOfRangeException();
        }
    }

    public static function visit_call_main(ServiceCall $serviceCall, IServiceProvider $provider): ?object {

        if ($serviceCall instanceof FactoryServiceCall) {
            $factory = $serviceCall->factory;

            if ($factory->getNumberOfParameters() !== 1) return $factory->invoke();

            return $factory->invoke($provider);
        }

        if ($serviceCall instanceof ConstructorServiceCall) {

            $parameters = [];

            foreach ($serviceCall->parameters as $parameter) {

                $parameters[] = static::visit_service_call($parameter, $provider);
            }

            return $serviceCall->constructor->invoke(...$parameters);
        }

        if ($serviceCall instanceof ServiceProviderCall) {
            return $provider;
        }

        return null;
    }

    public static function visit_singleton(ServiceCall $serviceCall, IServiceProvider $provider): ?object {

        if (is_object($serviceCall->value)) {
            return $serviceCall->value;
        }

        $resolved = static::visit_call_main($serviceCall, $provider);
        $serviceCall->value = $resolved;

        return $resolved;
    }

    public static function visit_transient(ServiceCall $serviceCall, IServiceProvider $provider): ?object {
        return static::visit_call_main($serviceCall, $provider);
    }
}
