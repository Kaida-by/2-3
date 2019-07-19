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
    <title>EditArticle</title>
</head>
<body>
<?php
if ($this->article !== false) {
    ?>
    <form action="?ctrl=AdminPanel&action=editArticle&id=<?php echo $_GET['id'] ?>" method="POST">
        Название:
        <p><input name="title" type="text" value="<?php echo $this->article->title; ?>"></p>
        Содержание:
        <p><textarea name="content" cols="25" rows="6">
        <?php
        echo $this->article->content;
        ?>
        </textarea></p>
        <p><button type="submit" name="submit">Редактировать</button></p>
    </form>
    <?php
} else {
    echo 'Извините, статья не найдена.';
}
?>
</body>
</html>
