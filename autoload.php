<?php

spl_autoload_register(function ($class) {
    $filePath = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($filePath)) {
        require $filePath;
    }
});
