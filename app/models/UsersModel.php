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
    public function authByLogin($login, $password)
    {
        $result = false;
        $error_message = '';

        if (empty($login)) {
            $error_message = 'Введите Ваш логин!';
        } elseif (empty($password)) {
            $error_message = 'Введите пароль!';
        }
        if (empty($error_message)) {
            $users = $this -> select(
                "SELECT * FROM `users` WHERE `login` =:login",
                [
                    'login' => $login
                ]
            );

            if (!empty($users[0])) {
                $passwordCorrect = password_verify($password, $users[0]['password']);

                if ($passwordCorrect) {
                    $_SESSION['user']['id'] = $users[0]['id'];
                    $_SESSION['user']['username'] = $users[0]['username'];
                    $_SESSION['user']['login'] = $users[0]['login'];
                    $_SESSION['user']['is_admin'] = ($users[0]['is_admin'] == '1');

                    $result = true;
                } else {
                    $error_message ='Неверный логин или пароль';
                }
            } else {
                $error_message ='Пользователь не найден';
            }
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function changePasswordByCurrentPassword($current_password, $new_password, $confirm_new_password)
    {
        $result = false;
        $error_message = '';

        if (empty($current_password)) {
            $error_message = 'Введите текущий пароль!';
        } elseif (empty($new_password)) {
            $error_message = 'Введите новый пароль!';
        } elseif (empty($confirm_new_password)) {
            $error_message = 'Введите подтверждение пароль!';
        } elseif ($new_password !== $confirm_new_password) {
            $error_message = 'Пароли не совпадают!';
        }
        if (empty($error_message)) {
            $users = $this -> select(
                "SELECT * FROM `users` WHERE `login` =:login",
                [
                    'login' => $_SESSION['user']['login']
                ]
            );

            if (!empty($users[0])) {
                $passwordCorrect = password_verify($current_password, $users[0]['password']);
                if ($passwordCorrect) {
                    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $updatePassword = $this->update(
                        'UPDATE `users` SET `password`=:password WHERE `login`=:login',
                        [
                            'login' => $_SESSION['user']['login'],
                            'password' => $new_password
                        ]
                    );
                    $result = $updatePassword;
                } else {
                    $error_message = 'Неверный пароль!';
                }
            } else {
                $error_message = 'Произошла ошибка при смене пароля!';
            }
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }
}