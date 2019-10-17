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
echo $this->table;
?>
<br>
<a href="index.php?ctrl=AdminPanel&action=showAuthors">Авторы:</a>
<br>
<a href="index.php?ctrl=AdminPanel&action=showUsers">Пользователи:</a>
</body>
</html>
