<?php


namespace app\models;

use app\core\BaseModel;

class UsersModel extends BaseModel
{
    public function addNewUser($username, $login, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $user_id = $this->inser(
            'INSERT INTO `users` (`username`, `login`, `password`) VALUES (:username, :login, :password)',
            [
                'username' => $username,
                'login' => $login,
                'password' => $password
            ]
        );
        return $user_id;
    }
}