<?php

require_once __DIR__ . '/autoload.php';

$article = new App\Models\Article();

if (isset($_POST['title']) && isset($_POST['content'])) {
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->save();
    header('Location: index.php');
}

include __DIR__ . '/template/addArticle.php';
