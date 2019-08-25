<?php

use App\Exceptions\Errors;
use App\Exceptions\DbException;
use App\Exceptions\E404Exception;
use App\View;

require_once __DIR__ . '/autoload.php';

session_start();

$ctrlName = $_GET['ctrl'] ?? 'ArticleController';
$action = $_GET['action'] ?? 'showAllNews';
$class = '\App\Controllers\\' . $ctrlName;

try {
    if (class_exists($class) &&
        method_exists($class, $action)) {
        /**@var \App\Controller $ctrl*/
        $ctrl = new $class;
        $ctrl->action($action);
    } else {
        $view = new View();
        $view->errors = 'Неверный url';
        $view->display(__DIR__ . '/template/error.php');
    }
} catch (DbException $error) {
    $view = new View();
    $view->errors = 'Ошибка в БД:  ' . $error->getMessage();
    $view->display(__DIR__ . '/template/error.php');
} catch (Errors $errors) {
    $view = new View();
    $view->errors = $errors->all();
    $view->display(__DIR__ . '/template/errors.php');
} catch (E404Exception $error) {
    $view = new View();
    $view->errors = $error->getMessage();
    $view->display(__DIR__ . '/template/error.php');
}
