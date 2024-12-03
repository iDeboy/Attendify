<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\Renderer;

class PruebasController {

    public function __construct(private readonly Renderer $renderer) {
    }

    public function index() {

        echo $this->renderer->view('Pages/PruebasPage.php');
    }
}
