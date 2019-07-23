<?php

namespace App\Controllers;

use App\Models\User;

class Login extends Guest
{
    protected function login()
    {
        $user = User::findAll();
        foreach ($user as $value) {
            if (!empty($_POST['login']) &&
                !empty($_POST['password']) &&
                $_POST['login'] == $value->name &&
                password_verify($_POST['password'], $value->password)) {
                $_SESSION['user'] = $_POST['login'];
            }
        }
        if (isset($_SESSION['user'])) {
            echo 'Вы вошли';
        } else {
            echo 'Неверный логин или пароль';
        }
    }
}
