<?php

declare(strict_types=1);

namespace DependencyInjection;

use Closure;
use InvalidArgumentException;
use ReflectionClass;

class ServiceProvider implements IServiceProvider {

    /** @var ServiceAccesor[] */
    private array $serviceAccesors = [];
    private readonly ServiceCallFactory $serviceCallFactory;

    public function __construct(ServiceCollection $collection) {

        $collection->make_readonly();

        $this->serviceCallFactory = new ServiceCallFactory($collection);
        $this->serviceCallFactory->add(IServiceProvider::class, new ServiceProviderCall);
    }

    public function get_service(string $serviceType): ?object {
        
        if (!isset($this->serviceAccesors[$serviceType])) $this->serviceAccesors[$serviceType] = $this->create_service_accesor(new ReflectionClass($serviceType));

        $serviceAccesor = $this->serviceAccesors[$serviceType];
        $result = $serviceAccesor->activeService->__invoke($this);

        return $result;
    }

    public function get_required_service(string $serviceType): object {

        $service = $this->get_service($serviceType);

        if ($service === null) throw new InvalidArgumentException("Servicio '$serviceType' no registrado.");

        return $service;
    }

    private function create_service_accesor(ReflectionClass $serviceType): ServiceAccesor {

        $serviceCall = $this->serviceCallFactory->get_service_call($serviceType, new ServiceCallChain);

        if ($serviceCall === null) return new ServiceAccesor($serviceCall, fn(IServiceProvider $provider): ?object => null);

        if ($serviceCall->lifetime === ServiceLifetime::Singleton) {

            // https://source.dot.net/#Microsoft.Extensions.DependencyInjection/ServiceProvider.cs,218
            $value = ServiceResolver::resolve($serviceCall, $this);
            return new ServiceAccesor($serviceCall, fn(IServiceProvider $provider): ?object => $value);
        }

        return new ServiceAccesor($serviceCall, fn(IServiceProvider $provider): ?object => ServiceResolver::resolve($serviceCall, $provider));
    }
}

class ServiceAccesor {

    public function __construct(
        public ?ServiceCall $serviceCall,
        public ?Closure $activeService
    ) {
    }
}
