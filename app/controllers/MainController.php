<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\MainsModels;


class MainController extends InitController
{
    /**
     * Вывод главной страницы
     *
     * @var array $brands — вывод брендов
     * @var array $hits - вывод хитов
     */
    public function actionIndex()
    {
        $this->view->title = 'Главная страница';

        $brandModel = new MainsModels();
        $brands = $brandModel->getListBrands();
        $hits = $brandModel->getListHits();

        $this->render('main', [
            'sidebar' => UserOperations::getMenuLinks(),
            'brands' => $brands,
            'hits' => $hits
        ]);
    }
}
