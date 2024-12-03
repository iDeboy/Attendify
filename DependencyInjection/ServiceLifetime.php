<?php
declare(strict_types=1);

namespace DependencyInjection;

enum ServiceLifetime {
    case Singleton;
    case Transient;
}