<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\ProductModels;

class ProductController extends InitController
{

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

    public static function getProductsList()
    {
        $productModel = new ProductModels();
        $productsList = $productModel->getProductsListAll();
        return $productsList;
    }

    /*public static function createProduct($options)
    {		
        $productModel = new ProductModels();
        $id = $productModel->getProductCreate($options);
        return $id;
    }*/
}