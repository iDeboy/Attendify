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
