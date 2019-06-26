<?php

require_once __DIR__ . '/../autoload.php';

function insertUsers()
{
    $db = \App\Db::getInstance();

    $users = App\Models\User::findAll();
    $name = 'Lin';
    $email = 'qwe@de.de';
    $sql = 'INSERT INTO users (name, email) VALUES (:name, :email)';
    $result = $db->execute($sql, [':name' => $name, ':email' => $email]);
    $laterUsers = $db->query('SELECT * FROM users ORDER BY id DESC');
    assert(true === $result);
    assert(count($laterUsers) === count($users) + 1);
    assert($laterUsers[0]->name === $name);
    assert($laterUsers[0]->email === $email);
}

function updateUsers()
{
    $db = \App\Db::getInstance();

    $name = 'Peter';
    $email = 'poi@ua.ua';
    $users = App\Models\User::findAll();
    assert(!empty($users));
    $randUser = array_rand($users);
    $randId = $users[$randUser]->getId();
    $sql = 'UPDATE users SET name=:name, email=:email WHERE id=:id';
    $result = $db->execute($sql, [':name' => $name, ':email' => $email, ':id' => $randId]);
    $sql = 'SELECT * FROM users WHERE id=:id';
    $users = $db->query($sql, [':id' => $randId]);
    assert(true === $result);
    assert($users[0]->name === $name);
    assert($users[0]->email === $email);
}

function deleteUser ()
{
    $db = \App\Db::getInstance();

    $sql = 'SELECT * FROM users ORDER BY id DESC';
    $users = $db->query($sql);
    assert(isset($users[0]));
    $id = $users[0]->id;
    $sql = 'DELETE FROM users WHERE :id=id';
    $result = $db->execute($sql, [':id' => $id]);
    $sql = 'SELECT * FROM users WHERE :id=id';
    $users = $db->query($sql, [':id' => $id]);
    assert(true === $result);
    assert(!isset($users[0]));
}

insertUsers();
updateUsers();
deleteUser();
