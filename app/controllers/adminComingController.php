<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\controllers\ProductController;
use app\models\AdminComingModels;

class adminComingController extends InitController
{
    public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['index', 'addendum', 'delete', 'edit'],
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
        $this->view->title = 'Приход товара';
        $productsList = ProductController::getProductsList(); // Получаем список товаров

        $adminComingModel = new AdminComingModels();
        $comings = $adminComingModel->getComing();
        //var_dump($coming);exit;
        $this->render('index', [
            'sidebar' => UserOperations::getMenuLinks(),
            'comings' => $comings
        ]);
    }

    // Добавление нового товара
    public function actionAddendum()
    {
        $this->view->title = 'Добавление нового товара';

        $errors = '';
        $result = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_addendum_form'])) {
            $options['title'] = !empty($_POST['title']) ? $_POST['title'] : null;
            $options['user'] = !empty($_POST['user']) ? $_POST['user'] : null;
            $options['count'] = !empty($_POST['count']) ? $_POST['count'] : null;

            if (!empty($options)) {
                $addendumModel = new AdminComingModels();
                $result_add = $addendumModel->getProductAddendum($options);
                if ($result_add['result']) {
                    $this->redirect('/adminComing/index');
                } else {
                    $errors = $result_add['errors'];
                }
            }
        }
        $this->render('addendum', [
            'sidebar' => UserOperations::getMenuLinks(),
            'errors' => $errors,
            //'result' => $result,

        ]);
    }

    // Action для страницы "Удалить товар"
    public function actionDelete()
    {
        $this->view->title = 'Удаление товара';
        $coming_id = !empty($_GET['coming_id']) ? $_GET['coming_id'] : null;
        $coming = null;
        $error_message = '';

        if (!empty($coming_id)) {
            $comingModel = new AdminComingModels();
            $coming = $comingModel->getProductById($coming_id);
            if (empty($coming)) {
                $error_message = 'Продукт не найден!';
            }
        } else {
            $error_message = 'Отсутствует индентификатор записи!';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_coming_delete_form'])) {
            $result_delete = $comingModel->deleteById($coming_id);

            if ($result_delete['result']) {
                $this->redirect('/adminComing/index');
            } else {
                $error_message = $result_delete['error_message'];
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_coming_notDelete_form'])) {
            $this->redirect('/adminComing/index');
        }

        $this->render('delete', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'coming' => $coming
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