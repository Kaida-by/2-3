<?php

require_once __DIR__ . '/autoload.php';

$article = \App\Models\Article::findById($_GET['id']);

if (isset($_POST['submit'])) {
    $article->delete();
    header('Location: index.php');
}
include __DIR__ . '/template/deleteArticle.php';
