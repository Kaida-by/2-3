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
    <style type="text/css">
        #footer {
            position: fixed;
            left: 0; bottom: 0;
        }
    </style>
</head>
<body>
<h1>Новости</h1>
{% for value in articles %}
<h2>{{ value.title }}</h2>
<p>{{ value.content }}</p>
{% endfor %}
<div id="footer">
    <h3>
        {{ time }}
    </h3>
</div>
</body>
</html>
