<?php

require_once __DIR__ . '/autoload.php';

$ctrl = $_GET['ctrl'] ?? 'ArticleController';

$class = '\App\Controllers\\' . $ctrl;

/**@var \App\Controller $ctrl*/

if (isset($_GET['ctrl']) && isset($_GET['action'])) {
    $ctrl = new $class;
    $ctrl->action($_GET['action']);
} else {
    $ctrl = new App\Controllers\ArticleController;
    $ctrl->action('showAllNews');
}
