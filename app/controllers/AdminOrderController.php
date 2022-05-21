<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\AdminOrderModels;
use app\models\CartModels;

class AdminOrderController extends InitController
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
                        'actions' => ['index', 'booking', 'addendum', 'delete', 'edit'],
                        'roles' => [UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/');
                        }
                    ]
                ]
            ]
        ];
    }

    /**
     * Вывод страницы 'Управление заказами'
     *
     * @var array $orders -  заказы
     */
    public function actionIndex()
    {
        $this->view->title = 'Управление заказами';

        $adminOrderModel = new AdminOrderModels();
        $orders = $adminOrderModel->getOrder();

        $this->render('index', [
            'sidebar' => UserOperations::getMenuLinks(),
            'orders' => $orders
        ]);
    }

    /**
     * Просмотр заказа
     *
     * @var integer $order_id - id заказа
     * @var array $orders - заказы
     * @var array $productsQuantity - массив с идентификаторами и количеством товаров
     * @var array $productsIds - массив c идентификаторами товаров
     * @var array $products - список товаров в заказе
     */
    public function actionBooking()
    {
        $this->view->title = 'Просмотр заказа';
        $order_id = !empty($_GET['order_id']) ? $_GET['order_id'] : null;
        $orders = null;
        $error_message = '';

        if (!empty($order_id)) {
            $adminOrderModel = new AdminOrderModels();
            $orders = $adminOrderModel->getOrderById($order_id);
            if (empty($orders)) {
                $error_message = 'Заказ не найден!';
            }
        } else {
            $error_message = 'Отсутствует индентификатор записи!';
        }


        $productsQuantity = json_decode($orders['products_in_cart'], true);

        $productsIds = array_keys($productsQuantity);

        $cartModel = new CartModels();
        $products = $cartModel->getProductsByIds($productsIds);

        $this->render('booking', [
            'sidebar' => UserOperations::getMenuLinks(),
            'orders' => $orders,
            'productsQuantity' => $productsQuantity,
            'products' => $products
        ]);
    }

    // Action для страницы "Удаление заказа"

    /**
     * Удаление заказа
     *
     * @var integer $order_id - id заказа
     * @var array $order - заказ
     */
    public function actionDelete()
    {
        $this->view->title = 'Удаление заказа';
        $order_id = !empty($_GET['order_id']) ? $_GET['order_id'] : null;
        $order = null;
        $error_message = '';


        if (!empty($order_id)) {
            $adminOrderModel = new AdminOrderModels();
            $order = $adminOrderModel->getOrderById($order_id);
            if (empty($order)) {
                $error_message = 'Заказ не найден!';
            }
        } else {
            $error_message = 'Отсутствует индентификатор записи!';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_order_delete_form'])) {
            $adminOrderModel = new AdminOrderModels();
            $result_delete = $adminOrderModel->deleteById($order_id);

            if ($result_delete['result']) {
                $this->redirect('/adminOrder/index');
            } else {
                $error_message = $result_delete['error_message'];
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_order_notDelete_form'])) {
            $this->redirect('/adminOrder/index');
        }

        $this->render('delete', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'order' => $order
        ]);
    }
}
