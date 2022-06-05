<?php


namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\CategoryModels;
use app\models\AdminCategoryModels;


class AdminCategoryController extends InitController
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
                        'actions' => ['index', 'addendum'],
                        'roles' => [ UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/user/login');
                        }
                    ]
                ]
            ]
        ];
    }

    /**
     * Вывод страницы категория товаров
     *
     * @var $categoryList array список категорий
     */
    public function actionIndex()
    {
        $this->view->title = 'Список категорий';

        //$categoryList = CategoryController::getCategoriesListAdmin;
        $categoryModel = new CategoryModels();
        $categoryList = $categoryModel->getCategoryAll();

        $this->render('index', [
            'sidebar' => UserOperations::getMenuLinks(),
            'categoryList' => $categoryList
        ]);
    }

    /**
     * Вывод страницы добавление новой категории
     */
    public function actionAddendum()
    {
        $this->view->title = 'Добавление новой категории';

        $errors = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_addendum_form'])) {
            $options['title'] = !empty($_POST['title']) ? $_POST['title'] : null;
            $options['alias'] = !empty($_POST['alias']) ? $_POST['alias'] : null;
            $options['parent_id'] = !empty($_POST['parent_id']) ? $_POST['parent_id'] : null;
            $options['keywords'] = !empty($_POST['keywords']) ? $_POST['keywords'] : null;
            $options['description'] = !empty($_POST['description']) ? $_POST['description'] : null;

            if (!empty($options)) {
                $addendumModel = new AdminCategoryModels();
                $result_add = $addendumModel->getProductAddendum($options);
                if ($result_add['result']) {
                    $this->redirect('/adminCategory/index');
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
     * Вывод страницы удаление категории
     *
     * @var integer $category_id id удаляемой категории
     * @var array $category - категория
     */
    public function actionDelete()
    {
        $this->view->title = 'Удаление категории';
        $category_id = !empty($_GET['category_id']) ? $_GET['category_id'] : null;
        $category = null;
        $error_message = '';

        if (!empty($category_id)) {
            $categoryModel = new AdminCategoryModels();
            $category = $categoryModel->getProductById($category_id);

            if (empty($category)) {
                $error_message = 'Продукт не найден!';
            }
        } else {
            $error_message = 'Отсутствует индентификатор записи!';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_coming_delete_form'])) {
            $result_delete = $categoryModel->deleteById($category_id);

            if ($result_delete['result']) {
                $this->redirect('/adminCategory/index');
            } else {
                $error_message = $result_delete['error_message'];
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_coming_notDelete_form'])) {
            $this->redirect('/adminCategory/index');
        }
        /**
         *
         * @param string $key - ключ массива кэша
         */

        $this->render('delete', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'category' => $category
        ]);
    }

    /**
     * Вывод страницы редактирование категории
     *
     * @var integer $category_id id редактируемой категории
     * @var array $category - категории
     */
    public function actionEdit()
    {
        $this->view->title = 'Редактирования категории';
        $category_id = !empty($_GET['category_id']) ? $_GET['category_id'] : null;
        $category = null;
        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_coming_edit_form'])) {
            $category_data = !empty($_POST['category']) ? $_POST['category'] : null;

            if (!empty($category_data)) {
                $categoryModel = new AdminCategoryModels();
                $result_edit = $categoryModel->edit($category_id, $category_data);
                if ($result_edit['result']) {
                    $this->redirect('/adminCategory/index');
                } else {
                    $error_message = $result_edit['error_message'];
                }
            }
        }

        if (!empty($category_id)) {
            $categoryModel = new AdminCategoryModels();
            $category = $categoryModel->getProductById($category_id);

            if (empty($category)) {
                $error_message = 'Категория не найдена!';
            }
        } else {
            $error_message = 'Отсутствует идентификатор записи!';
        }

        $this->render('edit', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'category' => $category
        ]);
    }
}
