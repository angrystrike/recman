<?php

function autoload($class_name)
{
    $class_name = str_replace("\\", DIRECTORY_SEPARATOR, $class_name);
    $path = ROOT . '/' . $class_name . '.php';
    if (is_file($path)) {
       include_once $path;
    }
}

spl_autoload_register('autoload');
