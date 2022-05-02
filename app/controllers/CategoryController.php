<?php


namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\CategoryModels;


class CategoryController extends InitController

{
    public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['index'],
                        'roles' => [UserOperations::RoleGuest, UserOperations::RoleUser, UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/user/login');
                        }
                    ]
                ]
            ]
        ];
    }

    public static function getCategoriesListAdmin()
    {
        $categoryModel = new CategoryModels();
        $categoryList = $categoryModel->getCategoryAll();
        return $categoryList;
    }

    public function actionIndex()
    {
        $this->view->title = 'Категория товара';

        $url = trim($_SERVER['REQUEST_URI'], '/');
        $params = explode('/', $url);
        $alias = $params[1];
        $products = null;
        $error_message = '';

        if (!empty($alias)) {
            $categoryModel = new CategoryModels();
            $products = $categoryModel->getListProducts($alias);
            if (empty($products)) {
                $error_message = 'Продукт не найден!';
            }
            $category = $categoryModel->getTitleCategory($alias);
            if (empty($category)) {
                $error_message = 'Категория не найдена!';
            }
        } else {
            $error_message = 'Отсутствует индентификатор записи!';
        }

        $this->render('index', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'products' => $products,
            'category' => $category,
        ]);
    }

    /*public function actionList()
    {
        $this->view->title = 'Карточка товара';

        $url = trim($_SERVER['REQUEST_URI'], '/');
        $params = explode('/', $url);
        $alias = $params[1];
        $product = null;
        $error_message = '';

        if (!empty($alias)) {
            $productModel = new CategorytModels();
            $product = $productModel->getOneProduct($alias);
            if (empty($product)) {
                $error_message = 'Продукт не найден!';
            }
        } else {
            $error_message = 'Отсутствует индентификатор записи!';
        }

        $this->render('list', [
            'sidebar' => UserOperations::getMenuLinks(),
            'product' => $product
        ]);
    }*/
}