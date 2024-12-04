<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\Renderer;

class LoginController {

    public function __construct(private readonly Renderer $renderer) {
    }

    public function index() {
        echo $this->renderer->view('Pages/LoginPage.php', styles: ['assets/css/style.css']);
    }
}
