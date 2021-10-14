<?php


namespace app\controllers;

use app\core\InitController;

class MainController extends InitController
{
    public function actionIndex()
    {
        echo 'Главная страница!';
    }
}