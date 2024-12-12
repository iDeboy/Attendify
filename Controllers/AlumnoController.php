<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\Renderer;

class AlumnoController {

    public function __construct(private readonly Renderer $renderer) {
    }

    public function principal() {
        echo $this->renderer->view('Pages/AlumnoPrincipalPage.php', layout: 'Layouts/AlumnoLayout.php');
    }

    public function grupo(string $grupoId) {
        echo $this->renderer->view('Pages/AlumnoGrupoPage.php', layout: 'Layouts/AlumnoLayout.php');
    }

    public function grupos_disponibles() {
        echo $this->renderer->view('Pages/AlumnoGruposDispPage.php', layout: 'Layouts/AlumnoLayout.php');
    }

    public function grupos_inscrito() {
        echo $this->renderer->view('Pages/AlumnoGruposInsPage.php', layout: 'Layouts/AlumnoLayout.php');
    }

}