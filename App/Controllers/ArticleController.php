<?php

namespace App\Controllers;

use \App\Models\Article;

class ArticleController extends Guest
{
    protected function showAllNews()
    {
        $this->view->articles = Article::findAll();
        $this->view->display(__DIR__ . '/../../template/index.php');
    }

    protected function showOneArticle()
    {
        $this->view->article = Article::findById($_GET['id']);
        $this->view->display(__DIR__ . '/../../template/article.php');
    }

    protected function handle($action)
    {
        if ($action == 'showOneArticle') {
            $this->showOneArticle();
        } elseif ($action == 'showAllNews') {
            $this->showAllNews();
        } else {
            echo 'Введите экшн';
        }
    }
}