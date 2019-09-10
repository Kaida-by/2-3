<?php

namespace App\Controllers;

use App\Exceptions\DbException;
use \App\Models\Article;

class ArticleController extends Guest
{
    protected $viewEngine = 'twig';

    protected function showAllNews()
    {
        $this->view->articles = Article::findAll();
        $this->view->display('index.twig');
    }

    /**
     * @throws DbException
     */
    protected function showOneArticle()
    {
        if (false !== Article::findById($_GET['id'])) {
            $this->view->article = Article::findById($_GET['id']);
            $this->view->display('article.twig');
        } else {
            throw new DbException('Ошибка 404 - не найдено');
        }
    }
}
