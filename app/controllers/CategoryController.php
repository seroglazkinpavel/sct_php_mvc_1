<?php


namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\CategoryModels;


class CategoryController extends InitController

{
    /**
     * Вывод контроль доступа
     *
     * @return array
     */
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
                    ],
                    [
                        'actions' => ['products'],
                        'roles' => [UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/user/login');
                        }
                    ]
                ]
            ]
        ];
    }

    /**
     * Получить список категорий
     *
     * @return array $categoryList
     */
    public static function getCategoriesListAdmin()
    {
        $categoryModel = new CategoryModels();
        $categoryList = $categoryModel->getCategoryAll();
        return $categoryList;
    }

    /**
     * Вывод страницы 'Категория товара'
     *
     * @var string $alias
     * @var array $category - Категория
     */
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

}
