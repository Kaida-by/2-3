<?php

namespace App\Controllers;

use App\Exceptions\DbException;
use \App\Models\Article;
use SebastianBergmann\Timer\Timer;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ArticleController extends Guest
{
    protected function showAllNews()
    {
        Timer::start();
        $loader = new FilesystemLoader(__DIR__ . '/../../template');
        $twig = new Environment($loader);
        Timer::stop();
        echo $twig->render('index.php', ['articles' => Article::findAll(), 'time' => Timer::resourceUsage()]);
    }

    /**
     * @throws DbException
     */
    protected function showOneArticle()
    {
        if (false !== Article::findById($_GET['id'])) {
            $loader = new FilesystemLoader(__DIR__ . '/../../template');
            $twig = new Environment($loader);
            echo $twig->render('article.php', ['article' => Article::findById($_GET['id'])]);
        } else {
            throw new DbException('Ошибка 404 - не найдено');
        }
    }
}
