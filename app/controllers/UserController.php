<?php


namespace app\controllers;

use app\core\InitController;


class UserController extends InitController
{
    public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['login'],
                        'roles' => ['guest'],
                        'matchCallback' => function() {
                            $this->redirect('/user/profile');
                        }
                    ]
                ]
            ]
        ];
    }

    public function actionLogin()
    {
        $this->view->title = 'Авторизация';
        $this->render('login');
    }
}
