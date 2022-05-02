<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\MainsModels;
use app\core\Cache;
use app\models\CategoryModels;


class MainController extends InitController
{
    /*public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['index'],
                        'roles' => [UserOperations::RoleGuest, UserOperations::RoleUser, UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/');
                        }
                    ]
                ]
            ]
        ];
    }*/

    public function actionIndex()
    {
        $this->view->title = 'Главная страница';

        $brandModel = new MainsModels();
        $brands = $brandModel->getListBrands();
        $hits = $brandModel->getListHits();

        $cats = InitController::cacheCategory();

        $this->render('main', [
            'sidebar' => UserOperations::getMenuLinks(),
            'brands' => $brands,
            'hits' => $hits
        ]);
    }
}
