<?php
/** @var \App\View $this */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
<a href ="addArticle.php">Добавить новость</a>
<hr>

<?php
foreach ($this->articles as $article) :
    echo '<h3>' . $article->title . '</h3>';
    echo $article->content;
    $author = $article->author;
    echo '<br>';
    if ($author) {
        echo 'Автор: ' . $author->name;
    }else{
        echo 'Неизвестный автор';
    }
    echo '<br>';
    echo '<a href ="deleteArticle.php?id=' . $article->getId() . '">Удалить новость</a>';
    echo '<br>';
    echo '<a href ="editArticle.php?id=' . $article->getId() . '">Редактировать новость</a>';
    echo '<hr>';
endforeach;
?>
</body>
</html>
