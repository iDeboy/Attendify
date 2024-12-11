<?php

declare(strict_types=1);


function dd($value) {

    d($value);

    die();
}

function d($value) {
    echo '<pre>';
    var_dump($value);
    echo '<pre>';
}

function template(string $template, array $data = []) {
    extract($data, EXTR_SKIP);
    require $template;
}

function render_template(string $template, array $data = []) {
    $level = ob_get_level();

    $content = '';

    ob_start();
    try {
        template($template, $data);
        $content = ob_get_clean();
    } catch (Throwable $e) {
        while (ob_get_level() > $level) ob_end_clean();
    }

    return $content;
}

function validarCorreo(string $correo): string|false {
    $correo = trim($correo);

    if (strlen($correo) > 100) return false;

    $regex = "/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/";

    if (!preg_match($regex, $correo)) return false;

    return $correo;
}

function validarPassword(string $password, string $confirmPassword): string|false {
    if (empty($password) || empty($confirmPassword)) return false;

    if (strcmp($password, $confirmPassword) !== 0) return false;

    return $password;
}
