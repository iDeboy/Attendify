<?php

require_once 'Core/functions.php';

spl_autoload_register('autoloader');

function autoloader($class) {

    $class_path = str_replace('\\', '/', $class);

    $file = "$class_path.php";

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
}
