<?php

declare(strict_types=1);

namespace Abstractions;

use DependencyInjection\IServiceProvider;
use DependencyInjection\ServiceCollection;
use DependencyInjection\ServiceProvider;
use InvalidArgumentException;

class Host {

    private static ?Host $current = null;

    public static function get_current(): ?Host {
        return static::$current;
    }

    public readonly IServiceProvider $services;

    public function __construct(ServiceCollection $collection) {
        if (static::$current !== null)
            throw new InvalidArgumentException('Solo puede haber un Host por aplicación.');
        
        static::$current = $this;

        $this->services = new ServiceProvider($collection);
    }
}
