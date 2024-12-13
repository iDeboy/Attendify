<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\DbContext;
use Abstractions\Renderer;

class RegistroController {

    public function __construct(
        private readonly Renderer $renderer,
        private readonly DbContext $db
    ) {
    }

    public function index() {

        if (is_user_auth('Logeado')) return header("Location: " . BASE_SITE . '/');

        echo $this->renderer->view('Pages/RegistroPage.php', scripts: ['assets/js/registro.js']);
    }

    public function registro() {

        $errors = [];
        $tipoUsuario = $this->validarUsuario($_POST['usuario']);
        if (!$tipoUsuario) {
            $errors[] = 'Tipo de usuario inválido, solo se permite Alumno o Docente.';
            goto end;
        }

        $id = $this->validarId($tipoUsuario, $_POST['id']);
        if (!$id) {
            $errors[] = strcmp($tipoUsuario, 'Alumno') === 0 ?
                'El número de control tiene un formato inválido o ya está registrado. Por favor, inténtalo más tarde.'
                : 'El RFC tiene un formato inválido o ya está registrado. Por favor, contacta con un administrador.';
        }

        $nombres = $this->validarNombres($_POST['nombres']);
        if (!$nombres) {
            $errors[] = 'El nombre es muy corto o muy largo. Por favor, contacta con el administrador.';
        }

        $apellidos = $this->validarApellidos($_POST['apellidos']);
        if (!$apellidos) {
            $errors[] = 'El apellido es muy corto o muy largo. Por favor, contacta con el administrador.';
        }

        $correo = $this->validarCorreo($tipoUsuario, $_POST['correo']);
        if (!$correo) {
            $errors[] = 'Correo ya registrado o inválido. Por favor, inténtalo de nuevo.';
        }

        $password = $this->validarPassword($_POST['password'], $_POST['confirmPassword']);
        if (!$password) {
            $errors[] = 'Las contraseñas no coinciden. Por favor, inténtalo de nuevo.';
        }

        $telefono = $this->validarTelefono($tipoUsuario, $_POST['telefono']);
        if (!$telefono) {
            $errors[] = 'El teléfono ya está registrado o tiene un formato inválido. Por favor, inténtalo de nuevo.';
        }

        end:

        if (count($errors) !== 0) {

            header('Location: ' . BASE_SITE . '/registro', response_code: 400);
            echo $this->renderer->view(
                'Pages/RegistroPage.php',
                ['Errors' => $errors],
                scripts: ['assets/js/registro.js']
            );
            return;
        }

        if (!$this->db->execute(
            "INSERT INTO $tipoUsuario VALUES(?,?,?,?,?,?);",
            "ssssss",
            [$id, $nombres, $apellidos, $telefono, $correo, password_hash($password, PASSWORD_BCRYPT)]
        )) {
            header('Location: ' . BASE_SITE . '/registro', response_code: 500);
            echo $this->renderer->view(
                'Pages/RegistroPage.php',
                ['Errors' => ["No se pudo registrar el $tipoUsuario. Por favor, inténtalo más tarde."]],
                scripts: ['assets/js/registro.js']
            );
            return;
        }

        header('Location: ' . BASE_SITE . '/login');
    }

    private function validarUsuario(string $tipoUsuario): string|false {
        if (
            strcmp($tipoUsuario, 'Alumno') === 0 ||
            strcmp($tipoUsuario, 'Profesor') === 0
        ) return $tipoUsuario;

        return false;
    }

    private function validarId(string $tipoUsuario, string $id): string|false {

        if (strcmp($tipoUsuario, 'Alumno') === 0) $regex = '/^[A-Z]?[0-9]{8}$/';
        else $regex = '/^[A-ZÑ&]{3,4}\d{6}[A-Z0-9]{2}[0-9A]$/';

        $id = strtoupper($id);

        if (!preg_match($regex, $id)) return false;

        if (strcmp($tipoUsuario, 'Alumno') === 0)
            $sql = "SELECT NoControl FROM Alumno WHERE NoControl = ?;";
        else
            $sql = "SELECT Rfc FROM Profesor WHERE Rfc = ?;";

        $result = $this->db->query($sql, [$id]);

        if (!empty($result)) return false;

        return $id;
    }

    private function validarNombres(string $nombres): string|false {

        $regex = "/^[A-Za-zÑÁÉÍÓÚñáéíóú ]{3,50}$/";

        $nombres = ucwords(trim($nombres));

        if (!preg_match($regex, $nombres)) return false;

        return $nombres;
    }

    private function validarApellidos(string $apellido): string|false {

        $regex = "/^[A-Za-zÑÁÉÍÓÚñáéíóú ]{3,50}$/";

        $apellido = ucwords(trim($apellido));

        if (!preg_match($regex, $apellido)) return false;

        return $apellido;
    }

    private function validarCorreo(string $tipoUsuario, string $correo): string|false {

        $correo = validarCorreo($correo);

        if (!$correo) return false;

        $sql = "SELECT Correo FROM $tipoUsuario WHERE Correo = ?;";

        $result = $this->db->query($sql, [$correo]);

        if (!empty($result)) return false;

        return $correo;
    }

    private function validarPassword(string $password, string $confirmPassword): string|false {
        return validarPassword($password, $confirmPassword);
    }

    private function validarTelefono(string $tipoUsuario, string $telefono): string|false {

        $telefono = validarTelefono($telefono);

        if (!$telefono) return false;

        $sql = "SELECT Telefono FROM $tipoUsuario WHERE Telefono = ?;";

        $result = $this->db->query($sql, [$telefono]);

        if (!empty($result)) return false;

        return $telefono;
    }
}
