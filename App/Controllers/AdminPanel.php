<?php

namespace App\Controllers;

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

    protected function editArticle()
    {
        $this->view->article = Article::findById($_GET['id']);

        if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['content'])) {
            $this->view->article->title = $_POST['title'];
            $this->view->article->content = $_POST['content'];
            $this->view->article->save();
            header('Location: index.php?ctrl=AdminPanel&action=showAllNews');
        } else {
            $this->view->display(__DIR__ . '/../../template/editArticle.php');
        }
    }

    protected function deleteArticle()
    {
        $this->view->article = Article::findById($_GET['id']);

        if (isset($_POST['submit'])) {
            $this->view->article->delete();
            header('Location: index.php?ctrl=AdminPanel&action=showAllNews');
        } else {
            $this->view->display(__DIR__ . '/../../template/deleteArticle.php');
        }
    }

    protected function addArticle()
    {
        $this->view->article = new Article();

        if (isset($_POST['title']) && isset($_POST['content'])) {
            $this->view->article->title = $_POST['title'];
            $this->view->article->content = $_POST['content'];
            $this->view->article->save();
            header('Location: index.php?ctrl=AdminPanel&action=showAllNews');
        } else {
            $this->view->display(__DIR__ . '/../../template/addArticle.php');
        }
    }

    protected function handle($action)
    {
        if ($action == 'addArticle') {
            $this->addArticle();
        } elseif ($action == 'deleteArticle') {
            $this->deleteArticle();
        } elseif ($action == 'editArticle') {
            $this->editArticle();
        } elseif ($action == 'showAllNews') {
            $this->showAllNews();
        } else {
            echo 'Неверный экшн';
        }
    }
}
