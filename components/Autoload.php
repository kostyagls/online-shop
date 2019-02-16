<?php

function my_autoloader($class_name) {
    $array_pass = array(
        '/components/',
        '/models/'
    );

    foreach ($array_pass as $path) {
        $filePath = ROOT . $path . $class_name . '.php';
        
        if (is_file($filePath)) {
            include_once $filePath;
        }
    }
}

spl_autoload_register('my_autoloader');