<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Abstractions\Host;
use Abstractions\Router;
use Controllers\AlumnoController;
use Controllers\DefaultController;
use Controllers\LoginController;
use Controllers\ProfesorController;
use Controllers\PruebasController;
use Controllers\RegistroController;
use Dotenv\Dotenv;

require_once 'Core/functions.php';
require_once 'program.php';

session_start();

$host = Host::get_current();

$env = $host->services->get_required_service(Dotenv::class);
$env->load();

$router = $host->services->get_required_service(Router::class);

$router->get('/', [DefaultController::class, 'index']);

$router->get('/pruebas', [PruebasController::class, 'index']);
$router->get('/login', [LoginController::class, 'index']);
$router->get('/registro', [RegistroController::class, 'index']);
$router->get('/alumno', [AlumnoController::class, 'principal']);
$router->get('/profesor', [ProfesorController::class, 'principal']);

$router->get('/alumno/grupos-disponibles', [AlumnoController::class, 'grupos_disponibles']);    
$router->get('/alumno/grupos', [AlumnoController::class, 'grupos_inscrito']);
$router->get('/alumno/grupos/{grupoId}', [AlumnoController::class, 'grupo']);

$router->get('/profesor/grupos', [ProfesorController::class, 'grupos_creados']);
$router->get('/profesor/crear-grupo', [ProfesorController::class, 'vista_crear_grupo']);
$router->get('/profesor/grupo/agregar-lista', [ProfesorController::class, 'agregar_lista']);
$router->get('/profesor/grupo/vista-lista', [ProfesorController::class, 'vista_lista']);

$router->post('/logout', [LoginController::class, 'logout']);
$router->post('/login', [LoginController::class, 'login']);
$router->post('/registro', [RegistroController::class, 'registro']);
$router->post('/api/profesor/crear-grupo', [ProfesorController::class, 'crear_grupo']);
$router->post('/api/profesor/crear-materia', [ProfesorController::class, 'crear_materia']);

$url = parse_url(htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8'));
$uri = $url['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
