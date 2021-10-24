<?php


namespace app\controllers;

use app\core\InitController;


class UserController extends InitController
{
    public function actionLogin()
    {
        $this->view->title = 'Авторизация';
        $this->render('login');
    }
}
