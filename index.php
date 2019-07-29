<?php

require_once __DIR__ . '/autoload.php';

$ctrl = $_GET['ctrl'] ?? 'ArticleController';

$class = '\App\Controllers\\' . $ctrl;

/**@var \App\Controller $ctrl*/

if (isset($_GET['ctrl']) && isset($_GET['action'])) {
    if (file_exists(__DIR__ . $class . '.php')) {
        if (class_exists($class) && method_exists($class, $_GET['action'])) {
            $ctrl = new $class;
            $ctrl->action($_GET['action']);
        } else {
            echo 'Введите корректный экшн';
        }
    } else {
        echo 'Такого контроллера не существует';
    }
} else {
    echo 'Введите ctrl или action';
}
