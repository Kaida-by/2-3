<?php

namespace App\Controllers;

use App\Exceptions\E404Exception;
use App\Models\Article;

class AdminPanel extends Admin
{
    protected function access()
    {
        return !empty($_SESSION['user']);
    }

    protected function showAllNews()
    {
        $this->view->articles = Article::findAll();
        $this->view->display(__DIR__ . '/../../template/index.php');
    }

    /**
     * @throws E404Exception
     */
    protected function editArticle()
    {
        $this->view->article = Article::findById($_GET['id']);
        if (false !== $this->view->article) {
            if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['content'])) {
                $this->view->article->fill(['title' => $_POST['title'], 'content'=>$_POST['content']]);
                $this->view->article->save();
                header('Location: index.php?ctrl=AdminPanel&action=showAllNews');
            } else {
                $this->view->display(__DIR__ . '/../../template/editArticle.php');
            }
        } else {
            throw new E404Exception('Ошибка 404 - не найдено');
        }
    }

    /**
     * @throws E404Exception
     */
    protected function deleteArticle()
    {
        $this->view->article = Article::findById($_GET['id']);
        if (false !== $this->view->article) {
            if (isset($_POST['submit'])) {
                $this->view->article->delete();
                header('Location: index.php?ctrl=AdminPanel&action=showAllNews');
            } else {
                $this->view->display(__DIR__ . '/../../template/deleteArticle.php');
            }
        } else {
            throw new E404Exception('Ошибка 404 - не найдено');
        }
    }

    protected function addArticle()
    {
        $this->view->article = new Article();
        if (isset($_POST['title']) && isset($_POST['content'])) {
            $this->view->article->fill(['title' => $_POST['title'], 'content'=>$_POST['content']]);
            $this->view->article->save();
            header('Location: index.php?ctrl=AdminPanel&action=showAllNews');
        } else {
            $this->view->display(__DIR__ . '/../../template/addArticle.php');
        }
    }
}
