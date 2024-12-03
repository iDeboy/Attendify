<?php

declare(strict_types=1);

namespace Abstractions;

use DependencyInjection\ServiceCollection;

class HostBuilder {

    public readonly ServiceCollection $services;

    private function __construct() {
        $this->services = new ServiceCollection;
    }

    public static function default_builder(): static {
        return new HostBuilder;
    }

    public function build(): Host {
        return new Host($this->services);
    }
}
