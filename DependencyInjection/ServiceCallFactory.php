<?php

declare(strict_types=1);

namespace DependencyInjection;

use Exception;
use InvalidArgumentException;
use OutOfRangeException;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;

// https://source.dot.net/#Microsoft.Extensions.DependencyInjection/ServiceLookup/CallSiteFactory.cs,370

class ServiceCallFactory {

    /** @var ServiceDescriptor[]  */
    private array $descriptors;

    /** @var ServiceDescriptorCacheItem[]  */
    private array $descriptorsLookup;

    /** @var ServiceCall[][]  */
    private array $serviceCallCache;

    public function __construct(ServiceCollection $collection) {

        if (!$collection->is_readonly())
            throw new InvalidArgumentException('La colección de servicios debe ser solo de lectura.');

        $this->descriptors = [];
        $collection->copy_to($this->descriptors);

        $this->descriptorsLookup = [];
        $this->serviceCallCache = [];

        $this->populate();
    }

    private function populate() {

        foreach ($this->descriptors as $descriptor) {

            $serviceType = $descriptor->serviceType;
            $implementationType = $descriptor->implementationType;

            if (!$implementationType->isInstantiable()) {
                throw new InvalidArgumentException("La implementación '{$implementationType->getName()}' no puede ser instanciada.");
            }

            $serviceName = $serviceType->getName();

            if (!isset($this->descriptorsLookup[$serviceName])) $cacheItem = new ServiceDescriptorCacheItem;
            else $cacheItem = $this->descriptorsLookup[$serviceName];

            $this->descriptorsLookup[$serviceName] = $cacheItem->add($descriptor);
        }
    }

    public function add(string $serviceType, ServiceCall $serviceCall) {
        $this->serviceCallCache[$serviceType][0] = $serviceCall;
    }

    public function get_service_call(ReflectionClass $serviceType, ServiceCallChain $callChain): ?ServiceCall {

        return isset($this->serviceCallCache[$serviceType->getName()][0]) ?
            $this->serviceCallCache[$serviceType->getName()][0] :
            $this->create_call($serviceType, $callChain);
    }

    private function create_call(ReflectionClass $serviceType, ServiceCallChain $callChain): ?ServiceCall {

        $callChain->check_circular_dependency($serviceType);

        if (isset($this->descriptorsLookup[$serviceType->getName()])) {
            $descriptor = $this->descriptorsLookup[$serviceType->getName()];

            return $this->try_create_exact($descriptor->last(), $serviceType, $callChain, 0);
        }

        return null;
    }

    private function try_create_exact(ServiceDescriptor $descriptor, ReflectionClass $serviceType, ServiceCallChain $callChain, int $slot): ?ServiceCall {

        if (strcmp($serviceType->getName(), $descriptor->serviceType->getName()) !== 0) return null;

        if (isset($this->serviceCallCache[$serviceType->getName()][$slot])) return $this->serviceCallCache[$serviceType->getName()][$slot];

        if ($descriptor->implementationFactory !== null)
            $serviceCall = new FactoryServiceCall($descriptor->lifetime, $serviceType, $descriptor->implementationFactory); // https://source.dot.net/#Microsoft.Extensions.DependencyInjection/ServiceLookup/CallSiteFactory.cs,388
        else
            $serviceCall = $this->create_constructor_service($descriptor->lifetime, $serviceType, $descriptor->implementationType, $callChain);

        return $serviceCall;
    }

    private function create_constructor_service(ServiceLifetime $lifetime, ReflectionClass $serviceType, ReflectionClass $implementationType, ServiceCallChain $callChain): ServiceCall {

        $callChain->add($serviceType, $implementationType);
        $constructor = $implementationType->getConstructor();

        if ($constructor === null) {
            $ctr = new ReflectionFunction($implementationType->newInstanceWithoutConstructor(...));
            return new ConstructorServiceCall($lifetime, $serviceType, $implementationType, $ctr);
        }

        $ctr = new ReflectionFunction($implementationType->newInstance(...));

        $paramsCount = $constructor->getNumberOfParameters();

        if ($paramsCount === 0)
            return new ConstructorServiceCall($lifetime, $serviceType, $implementationType, $ctr);

        $params = $constructor->getParameters();

        $parameters = [];

        foreach ($params as $param) {

            if ($param->getType()->isBuiltin())
                throw new InvalidArgumentException("Parametro '{$param->getName()}' debe de ser una tipo clase.");

            $serviceCall = $this->get_service_call($param->getClass(), $callChain);

            if ($serviceCall === null)
                throw new InvalidArgumentException("No se pudo resolver el servicio '{$param->getType()->getName()}'.");

            $parameters[] = $serviceCall;
        }

        return new ConstructorServiceCall($lifetime, $serviceType, $implementationType, $ctr, $parameters);
    }
}

class ServiceCallChain {

    /** @var ChainItemInfo[] */
    private array $serviceCallChain = [];

    public function check_circular_dependency(ReflectionClass $serviceType) {

        if (isset($this->serviceCallChain[$serviceType->getName()])) throw new InvalidArgumentException('Dependencia circular');
    }

    public function remove(ReflectionClass $serviceType) {
        unset($this->serviceCallChain[$serviceType->getName()]);
    }

    public function add(ReflectionClass $serviceType, ?ReflectionClass $implementationType = null) {
        $this->serviceCallChain[$serviceType->getName()] = new ChainItemInfo(count($this->serviceCallChain), $implementationType);
    }
}

class ChainItemInfo {

    public function __construct(
        public readonly int $order,
        public readonly ?ReflectionClass $implementationType = null
    ) {
    }
}

class ServiceDescriptorCacheItem {

    private ?ServiceDescriptor $item = null;

    /** @var ServiceDescriptor[]  */
    private array $items = [];

    public function last(): ServiceDescriptor {

        if ($this->items) {
            return $this->items[array_key_last($this->items)];
        }

        return $this->item;
    }

    public function count(): int {
        if ($this->item === null) return 0;

        return 1 + count($this->items);
    }

    public function get(int $index): ServiceDescriptor {

        if ($index >= $this->count()) throw new OutOfRangeException();

        if ($index === 0) return $this->item;

        return $this->items[$index - 1];
    }

    public function add(ServiceDescriptor $descriptor): self {

        $newCacheItem = new self;

        if (!$this->item) {
            $newCacheItem->item = $descriptor;
        } else {
            $newCacheItem->item = $this->item;
            $newCacheItem->items = $this->items;
            $newCacheItem->items[] = $descriptor;
        }

        return $newCacheItem;
    }

    public function get_slot(ServiceDescriptor $descriptor): int {

        if ($descriptor === $this->item) return $this->count() - 1;

        $index = array_search($descriptor, $this->items, true);

        if (!$index) return count($this->items) - ($index + 1);

        throw new Exception('Servicio no existe');
    }
}
