<?php

use App\Exceptions\Errors;
use App\Exceptions\DbException;
use App\View;

require_once __DIR__ . '/autoload.php';

session_start();

$ctrlName = $_GET['ctrl'] ?? 'ArticleController';
$action = $_GET['action'] ?? 'showAllNews';
$class = '\App\Controllers\\' . $ctrlName;

try {
    if (isset($_GET['ctrl']) &&
        isset($_GET['action']) &&
        class_exists($class) &&
        method_exists($class, $action)) {
        /**@var \App\Controller $ctrl*/
        $ctrl = new $class;
        $ctrl->action($_GET['action']);
    } else {
        $view = new View();
        $view->errors = 'Неверный url';
        $view->display(__DIR__ . '/template/error.php');
    }
} catch (DbException $error) {
    $view = new View();
    $view->errors = 'Ошибка в БД:  ' . $error->getMessage();
    $view->display(__DIR__ . '/template/error.php');
    die;
} catch (Errors $errors) {
    foreach ($errors->all() as $error) {
        echo $error->getMessage();
        echo '<br>';
    }
}
