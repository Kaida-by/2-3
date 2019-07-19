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
                return true;
            }
        }
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    protected function handle($action)
    {
        if ($action == 'login') {
            if ($this->login()) {
                header('Location: index.php?ctrl=AdminPanel&action=showAllNews');
            } else {
                die('Неверный логин или пароль!');
            }
        } else {
            die('ERROR!');
        }
    }
}
