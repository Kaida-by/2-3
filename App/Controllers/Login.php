<?php

namespace App\Controllers;

use App\Models\User;

class Login extends Guest
{
    protected $viewEngine = 'twig';

    protected function login()
    {
        if (isset($_POST['login'])) {
            $user = User::findByLogin($_POST['login']);
            if ($user) {
                if (!empty($_POST['login']) &&
                    !empty($_POST['password']) &&
                    $_POST['login'] == $user->name &&
                    password_verify($_POST['password'], $user->password)) {
                    $_SESSION['user'] = $_POST['login'];
                } else {
                    $this->view->result = 'Неверный логин или пароль';
                }
            } else {
                $this->view->result = 'Такого имени не существует';
            }
        }
        if (isset($_SESSION['user'])){
            header('Location: index.php?ctrl=AdminPanel&action=showAllNews');
        } else {
            $this->view->results = $this->view->result;
            $this->view->display('login.twig');
        }
    }
}
