<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\Renderer;

class RegistroController {

    public function __construct(private readonly Renderer $renderer) {
    }

    public function index() {
        echo $this->renderer->view('Pages/RegistroPage.php');
    }

    public function post() {
        echo "Apretaste el boton de registrar!";
    }
}