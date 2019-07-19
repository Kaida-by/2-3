<?php

require_once __DIR__ . '/App/autoload.php';

$ctrl = $_GET['ctrl'] ?? 'Index';

$class = '\App\Controllers\\' . $ctrl;

if (isset($_GET['ctrl']) && isset($_GET['action'])) {
    $ctrl = new $class;
    $ctrl->action($_GET['action']);
} else {
    echo 'Введите гет параметры';
}
