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
    <title>Index</title>
</head>
<body>
<h1>Новости</h1>
<?php
foreach ($this->articles as $article) :
    echo '<h3>' . $article->title . '</h3>';
    echo $article->content;
    echo '<br>';
    $author = $article->author;
    if ($author) {
        echo 'Автор: ' . $author->name;
    } else {
        echo 'Неизвестный автор';
    }
    echo '<br>';
    echo '<hr>';
endforeach;
?>
</body>
</html>
