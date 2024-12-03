<?php

declare(strict_types=1);

require_once 'autoload.php';

use Abstractions\Host;
use Abstractions\Router;

require_once 'Core/functions.php';
require_once 'program.php';

$host = Host::get_current();

$router = $host->services->get_required_service(Router::class);

$url = parse_url(htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8'));
$uri = $url['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);