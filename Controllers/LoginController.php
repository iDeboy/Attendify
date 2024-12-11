<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\Renderer;

class LoginController {

    public function __construct(private readonly Renderer $renderer) {
    }

    public function index() {
        echo $this->renderer->view('Pages/LoginPage.php');
    }

    public function login() {
        $error = null;
        $tipoUsuario = $this->validarUsuario($_POST['usuario']);
        if (!$tipoUsuario) {
            $error = 'Tipo de usuario inválido, solo se permite Alumno o Docente.';
            goto end;
        }

        $usuario = $this->validarCorreo($tipoUsuario, $_POST['correo']);
        if (!$usuario) {
            $error = 'Credenciales inválidas. Por favor, intente nuevamente.';
            goto end;
        }

        $passwordHash = ""; //$usuario->passwordHash;
        if (!$this->verificarPassword($_POST['password'], $passwordHash)) {
            $error = 'Credenciales inválidas. Por favor, intente nuevamente.';
            goto end;
        }

        end:
        if ($error !== null) {

            header('Location: /registro', response_code: 400);
            echo $this->renderer->view(
                'Pages/LoginPage.php',
                ['Error' => $error]
            );

            return;
        }

        echo "Inicio de sesión exitoso";

        // TODO: Crear $_SESSION['Logeado'] = true; para inicio de sesión persistente
        // TODO: Crear $_SESSION['Usuario'] con todos los campos de la tabla $tipoUsuario

        header('Location: /');
    }

    private function validarUsuario(string $tipoUsuario): string|false {
        if (
            strcmp($tipoUsuario, 'Alumno') === 0 ||
            strcmp($tipoUsuario, 'Docente') === 0
        ) return $tipoUsuario;

        return false;
    }

    private function validarCorreo(string $tipoUsuario, string $correo): object|false {

        $correo = validarCorreo($correo);

        // TODO: Ver no si no existe el correo en la base de datos
        // TODO: Obtener toda la tabla de $tipoUsuario y retornarla
        // TODO: Regresar el RFC o NoControl como Id

        return (object)$correo;
    }

    private function verificarPassword(string $password, string $passwordHash): bool {
        return password_verify($password, $passwordHash);
    }
}
