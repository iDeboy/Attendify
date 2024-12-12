<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\Renderer;

class ProfesorController {

    public function __construct(private readonly Renderer $renderer) {
    }

    public function principal() {

        if (needs_login('Logeado', 'login')) return;

        echo $this->renderer->view(
            'Pages/ProfesorPrincipalPage.php',
            ['Profesor' => $_SESSION['Usuario']],
            layout: 'Layouts/ProfesorLayout.php'
        );
    }

    public function grupos_creados() {

        if (needs_login('Logeado', 'login')) return;

        echo $this->renderer->view(
            'Pages/ProfesorGruposCreaPage.php',
            ['Profesor' => $_SESSION['Usuario']],
            layout: 'Layouts/ProfesorLayout.php'
        );
    }
}
