<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <p>Войти как админ:</p>
    <form action="?ctrl=Login&action=login" method="POST">
        Логин: <input type="text" name="login">
        Пароль: <input type="password" name="password">
        <input type="submit" name="submit">
    </form>
    <?php
    echo $this->result;
    ?>
</body>
</html>