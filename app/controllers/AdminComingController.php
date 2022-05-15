<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\controllers\ProductController;
use app\models\AdminComingModels;

class AdminComingController extends InitController
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

    /**
     * Вывод страницы прихода товаров
     *
     * @var $comings array список товаров
     */
    public function actionIndex()
    {
        $this->view->title = 'Приход товара';

        $adminComingModel = new AdminComingModels();
        $comings = $adminComingModel->getComing();

        $this->render('index', [
            'sidebar' => UserOperations::getMenuLinks(),
            'comings' => $comings
        ]);
    }

    /**
     * Вывод страницы добавление нового товаро
     */
    public function actionAddendum()
    {
        $this->view->title = 'Добавление нового товара';

        $errors = '';

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
        ]);
    }

    /**
     * Вывод страницы удаление товара
     *
     * @var integer $coming_id id удаляемого товара
     * @var array $coming -товар
     */
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

    /**
     * Вывод страницы редактирование товара
     *
     * @var integer $coming_id id удаляемого товара
     * @var array $coming -товар
     */
    public function actionEdit()
    {
        $this->view->title = 'Редактирования товара';
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
            $coming = $comingModel->getProductById($coming_id);

            if (empty($coming)) {
                $error_message = 'Товар не найден!';
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
