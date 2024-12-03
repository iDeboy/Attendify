<?php

namespace DependencyInjection;

interface IServiceProvider {

    /**
     * @template T
     * @param class-string<T> $serviceType
     * @return T|null
     **/
    public function get_service(string $serviceType): ?object;

    /**
     * @template T
     * @param class-string<T> $serviceType
     * @return T
     **/
    public function get_required_service(string $serviceType): object;
}
