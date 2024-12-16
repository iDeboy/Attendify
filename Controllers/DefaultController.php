<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\Renderer;

class DefaultController {

    public function __construct(
        private readonly Renderer $renderer
    ) {
    }

    public function index() {

        if (needs_login('Logeado', 'login')) return;

        $usuario = $_SESSION['Usuario'];

        if (strcmp($usuario->Tipo, 'Alumno') === 0) header('Location: ' . BASE_SITE . '/alumno');
        else header('Location: ' . BASE_SITE . '/profesor');
    }

    public function acerca_de() {
        echo $this->renderer->view('Pages/AcercaDePage.php');
    }
}
