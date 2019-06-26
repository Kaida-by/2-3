<?php

require_once __DIR__ . '/autoload.php';

$article = \App\Models\Article::findById($_GET['id']);

if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['content'])) {
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->save();
    header('Location: index.php');
}

include __DIR__ . '/template/editArticle.php';
