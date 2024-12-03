<?php

declare(strict_types=1);

namespace DependencyInjection;

use Closure;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionFunction;

require_once 'Core/functions.php';

class ServiceDescriptor {

    public readonly ReflectionClass $serviceType;
    public readonly ReflectionClass $implementationType;
    public readonly ?ReflectionFunction $implementationFactory;

    public function __construct(
        string $serviceType,
        mixed $implementation,
        public readonly ServiceLifetime $lifetime
    ) {

        if (is_string($implementation)) {
            if (!is_subclass_of($implementation, $serviceType) && $implementation !== $serviceType)
                throw new InvalidArgumentException("La implementación $implementation no es una subclase de $serviceType.");

            $this->implementationType = new ReflectionClass($implementation);
            $this->implementationFactory = null;
        } else if (is_callable($implementation)) {
            $this->implementationFactory = new ReflectionFunction($implementation);
            $returnType = $this->implementationFactory->getReturnType();

            $params_count = $this->implementationFactory->getNumberOfParameters();

            if ($params_count > 1)
                throw new InvalidArgumentException("La implementación tiene muchos argumentos, solo puede tener 0 o 1 argumento.");

            if ($params_count === 1) {

                $first_param = $this->implementationFactory->getParameters()[0];
                $param_type = $first_param->getType()?->getName();

                if ($param_type !== 'IServiceProvider')
                    throw new InvalidArgumentException("El primer argumento debe ser del tipo interfaz 'IServiceProvider'.");
            }

            if ($returnType === null)
                throw new InvalidArgumentException("La implementación no tiene un tipo de retorno definido. Nota: Verifica si el tipo de retorno está especificado en la función.");

            $returnTypeName = $returnType->getName();

            if (!is_subclass_of($returnTypeName, $serviceType) && $returnTypeName !== $serviceType)
                throw new InvalidArgumentException("La implementación no retorna una instancia de $serviceType.");

            $this->implementationType = new ReflectionClass($returnTypeName);
        } else {
            throw new InvalidArgumentException("El segundo parámetro debe ser un nombre de clase o un callable.");
        }

        $this->serviceType = new ReflectionClass($serviceType);
    }

    public static function singleton(string $serviceType, callable|string|null $implementation = null): static {

        if ($implementation === null) return new static($serviceType, $serviceType, ServiceLifetime::Singleton);

        return new static($serviceType, $implementation, ServiceLifetime::Singleton);
    }

    public static function transient(string $serviceType, callable|string|null $implementation = null): static {

        if ($implementation === null) return new static($serviceType, $serviceType, ServiceLifetime::Transient);

        return new static($serviceType, $implementation, ServiceLifetime::Transient);
    }
}
