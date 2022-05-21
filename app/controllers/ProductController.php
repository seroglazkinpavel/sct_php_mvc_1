<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\ProductModels;

class ProductController extends InitController
{
    /**
     * Вывод 'Карточка товара'
     *
     * @var array $product
     */
    public function actionList()
    {
        $this->view->title = 'Карточка товара';

        $productModel = new ProductModels();
        $product = $productModel->getOneProduct();

        $this->render('list', [
            'sidebar' => UserOperations::getMenuLinks(),
            'product' => $product
        ]);
    }

    /**
     * Вывод списка продуктов
     *
     * @return array $productsList
     */
    public static function getProductsList()
    {
        $productModel = new ProductModels();
        $productsList = $productModel->getProductsListAll();
        return $productsList;
    }
}
