<?php

require_once __DIR__ . '/autoload.php';

$ctrl = $_GET['ctrl'] ?? 'Index';

$class = '\App\Controllers\\' . $ctrl;

if (isset($_GET['ctrl']) && isset($_GET['action'])) {
    /**@var \App\Controller $ctrl*/
    $ctrl = new $class;
    $ctrl->action($_GET['action']);
} else {
    echo 'Введите гет параметры';
}
