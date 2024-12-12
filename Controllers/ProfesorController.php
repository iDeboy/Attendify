<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\Renderer;

class ProfesorController {

    public function __construct(private readonly Renderer $renderer) {
    }

    public function principal() {
        echo $this->renderer->view('Pages/ProfesorPrincipalPage.php', layout: 'Layouts/ProfesorLayout.php');
    }

    public function grupos_creados() {
        echo $this->renderer->view('Pages/ProfesorGruposCreaPage.php', layout: 'Layouts/ProfesorLayout.php');
    }
}
