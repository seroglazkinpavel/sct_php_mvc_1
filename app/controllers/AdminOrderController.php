<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\AdminOrderModels;
use app\models\CartModels;

class AdminOrderController extends InitController
{
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

    public function actionIndex()
    {
        $this->view->title = 'Управление заказами';

        $adminOrderModel = new AdminOrderModels();
        $orders = $adminOrderModel->getOrder();
        //var_dump($coming);exit;
        $this->render('index', [
            'sidebar' => UserOperations::getMenuLinks(),
            'orders' => $orders
        ]);
    }

    // Просмотр заказа
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


        $productsQuantity = json_decode($orders['products_in_cart'], true); // Получаем массив идентификаторами и количеством товаров

        $productsIds = array_keys($productsQuantity); // Получаем массив c идентификаторами товаров

        $cartModel = new CartModels();
        $products = $cartModel->getProductsByIds($productsIds); // Получаем список товаров в заказе
        //var_dump($products);exit;
        $this->render('booking', [
            'sidebar' => UserOperations::getMenuLinks(),
            'orders' => $orders,
            'productsQuantity' => $productsQuantity,
            'products' => $products
        ]);
    }

    // Action для страницы "Удаление заказа"
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

    public function actionEdit()
    {
        $this->view->title = 'Редактирования пользователя';
        $coming_id = !empty($_GET['coming_id']) ? $_GET['coming_id'] : null;
        $coming = null;
        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_coming_edit_form'])) {
            $coming_data = !empty($_POST['coming']) ? $_POST['coming'] : null;

            if (!empty($coming_data)) {
                $comingModel = new AdminComingModels();
                $result_edit = $comingModel->edit($coming_id, $coming_data);
                if ($result_edit['result']) {
                    $this->redirect('/adminComing/index');
                } else {
                    $error_message = $result_edit['error_message'];
                }
            }
        }

        if (!empty($coming_id)) {
            $comingModel = new AdminComingModels();
            $coming = $comingModel->getComingById($coming_id);

            if (empty($coming)) {
                $error_message = 'Пользователь не найден!';
            }
        } else {
            $error_message = 'Отсутствует идентификатор записи!';
        }

        $this->render('edit', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'coming' => $coming
        ]);
    }
}
