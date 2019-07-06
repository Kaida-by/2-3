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
    <title>DeleteArticle</title>
</head>
<body>
<?php
if ($this->article !== false) {
    ?>
    <form action="deleteArticle.php?id=<?php echo $_GET['id'] ?>" method="POST">
        <h3><?php echo $this->article->title ?></h3>
        <p><?php echo $this->article->content ?></p>
        <p><button type="submit" name="submit">Удалить</button></p>
    </form>
    <?php
} else {
    echo 'Извините, статья не найдена.';
}
?>
</body>
</html>
