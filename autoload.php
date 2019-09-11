<?php
function load($namespace)
{
    $namespace = str_replace('\\', '/', $namespace);

    $absolute_path = __DIR__ . '/' . $namespace . ".php";

    return include_once $absolute_path;
}

spl_autoload_register(__NAMESPACE__ . "\load");
