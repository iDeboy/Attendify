<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\Renderer;

class AlumnoController {

    public function __construct(private readonly Renderer $renderer) {
    }

    public function principal() {

        if (needs_login('Logeado', 'login')) return;

        echo $this->renderer->view(
            'Pages/AlumnoPrincipalPage.php',
            ['Alumno' => $_SESSION['Usuario']],
            layout: 'Layouts/AlumnoLayout.php'
        );
    }

    public function grupo(string $grupoId) {

        if (needs_login('Logeado', 'login')) return;

        echo $this->renderer->view(
            'Pages/AlumnoGrupoPage.php',
            ['Alumno' => $_SESSION['Usuario']],
            layout: 'Layouts/AlumnoLayout.php'
        );
    }

    public function grupos_disponibles() {

        if (needs_login('Logeado', 'login')) return;

        echo $this->renderer->view(
            'Pages/AlumnoGruposDispPage.php',
            ['Alumno' => $_SESSION['Usuario']],
            layout: 'Layouts/AlumnoLayout.php'
        );
    }

    public function grupos_inscrito() {

        if (needs_login('Logeado', 'login')) return;

        echo $this->renderer->view(
            'Pages/AlumnoGruposInsPage.php',
            ['Alumno' => $_SESSION['Usuario']],
            layout: 'Layouts/AlumnoLayout.php'
        );
    }
}
