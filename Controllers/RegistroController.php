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
            $errors[] = 'Correo inválido. Por favor, ingrese otro.';
        }

        $password = $this->validarPassword($_POST['password'], $_POST['confirmPassword']);
        if (!$password) {
            $errors[] = 'Las contraseñas no coinciden. Por favor, inténtalo de nuevo.';
        }

        $telefono = $this->validarTelefono($_POST['telefono']);
        if (!$telefono) {
            $errors[] = 'El teléfono tiene un formato inválido. Por favor, inténtalo de nuevo.';
        }

        end:

        if (count($errors) !== 0) {

            header('Location: /registro', response_code: 400);
            echo $this->renderer->view(
                'Pages/RegistroPage.php',
                ['Errors' => $errors],
                scripts: ['assets/js/registro.js']
            );
            return;
        }

        header('Location: /login');
    }

    private function validarUsuario(string $tipoUsuario): string|false {
        if (
            strcmp($tipoUsuario, 'Alumno') === 0 ||
            strcmp($tipoUsuario, 'Docente') === 0
        ) return $tipoUsuario;

        return false;
    }

    private function validarId(string $tipoUsuario, string $id): string|false {

        if (strcmp($tipoUsuario, 'Alumno') === 0) $regex = '/^([A-Z]\d{8,19}|\d{8,20})$/';
        else $regex = '/^[A-ZÑ&]{3,4}\d{6}[A-Z0-9]{2}[0-9A]$/';

        $id = strtoupper($id);

        if (!preg_match($regex, $id)) return false;

        // TODO: Ver no si no existe el id en la base de datos

        return $id;
    }

    private function validarNombres(string $nombres): string|false {

        $regex = "/^[a-zA-ZÑ ]{3,50}$/";

        $nombres = trim($nombres);

        if (!preg_match($regex, $nombres)) return false;

        return $nombres;
    }

    private function validarApellidos(string $apellido): string|false {

        $regex = "/^[a-zA-ZÑ ]{3,50}$/";

        $apellido = trim($apellido);

        if (!preg_match($regex, $apellido)) return false;

        return $apellido;
    }

    private function validarCorreo(string $tipoUsuario, string $correo): string|false {

        $correo = validarCorreo($correo);

        // TODO: Ver no si no existe el correo en la base de datos

        return $correo;
    }

    private function validarPassword(string $password, string $confirmPassword): string|false {
        return validarPassword($password, $confirmPassword);
    }

    private function validarTelefono(string $telefono): string|false {

        $regex = "/^\d{10,15}$/i";

        $telefono = trim($telefono);

        if (!preg_match($regex, $telefono)) return false;

        return $telefono;
    }
}
