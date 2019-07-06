<?php

require_once __DIR__ . '/autoload.php';

$view = new App\View();

$view->article = \App\Models\Article::findById($_GET['id']);

if (isset($_POST['submit'])) {
    $view->article->delete();
    header('Location: index.php');
} else {
    $view->display(__DIR__ . '/template/deleteArticle.php');
}
