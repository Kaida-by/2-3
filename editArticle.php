<?php

require_once __DIR__ . '/autoload.php';

$view = new App\View();

$view->article = \App\Models\Article::findById($_GET['id']);

if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['content'])) {
    $view->article->title = $_POST['title'];
    $view->article->content = $_POST['content'];
    $view->article->save();
    header('Location: index.php');
} else {
    $view->display(__DIR__ . '/template/editArticle.php');
}
