<?php

require_once __DIR__ . '/autoload.php';

$view = new App\View();

$view->aaa = ['one', 'two', 'three'];

$view->articles = \App\Models\Article::findAll();

$view->display(__DIR__ . '/template/index.php');
