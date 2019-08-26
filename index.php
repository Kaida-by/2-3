<?php

use App\Exceptions\Errors;
use App\Exceptions\DbException;
use App\Exceptions\E404Exception;
use App\View;
use App\Logger;

require_once __DIR__ . '/autoload.php';

session_start();

$ctrlName = $_GET['ctrl'] ?? 'ArticleController';
$action = $_GET['action'] ?? 'showAllNews';
$class = '\App\Controllers\\' . $ctrlName;

try {
    if (class_exists($class) && method_exists($class, $action)) {
        /**@var \App\Controller $ctrl*/
        $ctrl = new $class;
        $ctrl->action($action);
    } else {
        throw new E404Exception('Ошибка 404 - не найдено');
    }
} catch (DbException $error) {
    $log = new Logger();
    $log->setLog('Ошибка в БД:  ' . $error->getMessage());
    $view = new View();
    $view->display(__DIR__ . '/template/error.php');
} catch (Errors $errors) {
    $view = new View();
    $view->errors = $errors->all();
    $view->display(__DIR__ . '/template/errors.php');
} catch (E404Exception $error) {
    $log = new Logger();
    $log->setLog($error->getMessage());
    $view = new View();
    $view->display(__DIR__ . '/template/error.php');
}
