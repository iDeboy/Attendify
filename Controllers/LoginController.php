<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\DbContext;
use Abstractions\Renderer;

class LoginController {

    public function __construct(
        private readonly Renderer $renderer,
        private readonly DbContext $db
    ) {
    }

    public function index() {

        if (is_user_auth('Logeado')) return header('Location: ' . BASE_SITE . '/');

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

        $passwordHash = $usuario->passwordHash;
        if (!$this->verificarPassword($_POST['password'], $passwordHash)) {
            $error = 'Credenciales inválidas. Por favor, intente nuevamente.';
            goto end;
        }

        end:
        if ($error !== null) {

            header('Location: ' . BASE_SITE . '/registro', response_code: 400);
            echo $this->renderer->view(
                'Pages/LoginPage.php',
                ['Error' => $error]
            );

            return;
        }

        $_SESSION['Logeado'] = true;
        $_SESSION['Usuario'] = $usuario;

        header('Location: ' . BASE_SITE . '/');
    }

    private function validarUsuario(string $tipoUsuario): string|false {
        if (
            strcmp($tipoUsuario, 'Alumno') === 0 ||
            strcmp($tipoUsuario, 'Profesor') === 0
        ) return $tipoUsuario;

        return false;
    }

    private function validarCorreo(string $tipoUsuario, string $correo): object|false {

        $correo = validarCorreo($correo);

        if (strcmp($tipoUsuario, 'Alumno') === 0)
            $sql = "SELECT 'Alumno' AS tipo, noControl AS id, nombre, apellidos, telefono, correoAlum AS correo, passwordHash 
                    FROM Alumno 
                    WHERE correoAlum = ?;";
        else
            $sql = "SELECT 'Profesor' AS tipo, rfc AS id, nombre, apellidos, telefono, correoProf As correo, passwordHash
                    FROM Profesor 
                    WHERE correoProf = ?;";

        $result = $this->db->query($sql, [$correo]);

        if (!$result || empty($result)) return false;

        return $result[0];
    }

    private function verificarPassword(string $password, string $passwordHash): bool {
        return password_verify($password, $passwordHash);
    }

    public function logout() {

        if (!is_user_auth('Logeado')) return;

        session_unset();
        session_destroy();

        header('Location: ' . BASE_SITE . '/login');
    }
}
