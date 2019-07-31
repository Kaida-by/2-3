<?php

require_once __DIR__ . '/autoload.php';

session_start();

$ctrl = $_GET['ctrl'] ?? 'ArticleController';

$class = '\App\Controllers\\' . $ctrl;

/**@var \App\Controller $ctrl*/

if (isset($_GET['ctrl']) &&
    isset($_GET['action']) &&
    class_exists($class) &&
    method_exists($class, $_GET['action'])) {
    $ctrl = new $class;
    $ctrl->action($_GET['action']);
} else {
    echo 'Неправильный url';
}
