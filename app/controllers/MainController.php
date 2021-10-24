<?php


namespace app\controllers;

use app\core\InitController;

class MainController extends InitController
{
    public function actionIndex()
    {
        $this->view->title = 'Главная страница';
        $this->render('main');
    }
}
