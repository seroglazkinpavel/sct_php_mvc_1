<?php


namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\controllers\ProductController;
use app\models\ProductModels;
use app\controllers\CategoryController;

class AdminProductController extends InitController
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
                        'actions' => ['index', 'delete', 'create'],
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
     * Вывод страницы "Управления товароми"
     *
     * @var array $productsList список товаров
     */
    public function actionIndex()
    {
        $this->view->title = 'Управления товароми';

        $productsList = ProductController::getProductsList();

        $this->render('index', [
            'sidebar' => UserOperations::getMenuLinks(),
            'role' => UserOperations::getRoleUser(),
            'productsList' => $productsList

        ]);
    }

    /**
     * Вывод страницы удаление товара
     *
     * @var integer $product_id id удаляемого товара
     * @var array $product -товар
     */
    public function actionDelete()
    {
        $this->view->title = 'Удаление товара';
        $product_id = !empty($_GET['product_id']) ? $_GET['product_id'] : null;
        $product = null;
        $error_message = '';


        if (!empty($product_id)) {
            $productModel = new ProductModels();
            $product = $productModel->getProductById($product_id);
            if (empty($product)) {
                $error_message = 'Продукт не найден!';
            }
        } else {
            $error_message = 'Отсутствует индентификатор записи!';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_product_delete_form'])) {
            $result_delete = $productModel->deleteById($product_id);

            if ($result_delete['result']) {
                $this->redirect('/adminProduct/index');
            } else {
                $error_message = $result_delete['error_message'];
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_product_notDelete_form'])) {
            $this->redirect('/adminProduct/index');
        }

        $this->render('delete', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'product' => $product
        ]);

    }

    /**
     * Вывод страницы "Добавления товара"
     *
     * @var array $categoriesList - список категорий
     */
    public function actionCreate()
    {
        $this->view->title = 'Добавление товара';
        $errors = '';
        $result = '';
        $categoriesList = CategoryController::getCategoriesListAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_create_form'])) {
            $options['category_id'] = !empty($_POST['category_id']) ? $_POST['category_id'] : null;
            $options['title'] = !empty($_POST['title']) ? $_POST['title'] : null;
            $options['alias'] = !empty($_POST['alias']) ? $_POST['alias'] : null;
            $options['price'] = !empty($_POST['price']) ? $_POST['price'] : null;
            $options['status'] = !empty($_POST['status']) ? $_POST['status'] : null;
            $options['depart'] = !empty($_POST['depart']) ? $_POST['depart'] : null;
            $options['article'] = !empty($_POST['article']) ? $_POST['article'] : null;
            $options['grade'] = !empty($_POST['grade']) ? $_POST['grade'] : null;
            $options['height'] = !empty($_POST['height']) ? $_POST['height'] : null;
            $options['img'] = !empty($_FILES['img']) ? $_FILES['img'] : null;

            // получить подробную информацию о загруженном файле
            $fileTmpPath = $options['img']['tmp_name'];
            $fileName = $options['img']['name'];
            $fileSize = $options['img']['size'];
            $fileType = $options['img']['type'];
            //$fileNameCmps = explode(".", $fileName);
            //$fileExtension = strtolower(end($fileNameCmps));  // расширение загруженного файла
            //$newFileName = md5(time() . $fileName) . '.' . $fileExtension; // очистим имя файла
            $pathFile = $_SERVER['DOCUMENT_ROOT'].'/upload/images/products/'.$fileName;
            if (!move_uploaded_file($options['img']['tmp_name'], $pathFile)) {
                echo 'Файл не смог загрузиться.';
            }

            if (!empty($options)) {
                $productModel = new ProductModels();
                $result_add = $productModel->getProductCreate($options);
                if ($result_add['result']) {
                    //$result = 'Товар успешно добавлен!';
                    $this->redirect('/adminProduct/index');
                } else {
                    $errors = $result_add['errors'];
                }
            }
        }
        $this->render('create', [
            'sidebar' => UserOperations::getMenuLinks(),
            'errors' => $errors,
            //'result' => $result,
            'categoriesList' => $categoriesList
        ]);
    }

    /**
     * Вывод страницы редактирование товара
     *
     * @var integer $product_id id удаляемого товара
     * @var array $product -товар
     * @var array $product_data
     */
    public function actionEdit()
    {
        $this->view->title = 'Редактирования товара';
        $product_id = !empty($_GET['product_id']) ? $_GET['product_id'] : null;
        $product = null;
        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_edit_product_form'])) {
            $product_data = !empty($_POST['product']) ? $_POST['product'] : null;

            if (!empty($product_data)) {
                $productModel = new ProductModels();
                $result_edit = $productModel->edit($product_id, $product_data);
                if ($result_edit['result']) {
                    $this->redirect('/adminProduct/index');
                } else {
                    $error_message = $result_edit['error_message'];
                }
            }
        }

        if (!empty($product_id)) {
            $productModel = new ProductModels();
            $product = $productModel->getProductById($product_id);
            if (empty($product)) {
                $error_message = 'Пользователь не найден!';
            }
        } else {
            $error_message = 'Отсутствует идентификатор записи!';
        }

        $this->render('edit', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'product' => $product
        ]);
    }
}
