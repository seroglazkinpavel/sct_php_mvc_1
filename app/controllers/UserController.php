<?php


namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\UsersModel;
use app\models\AdminOrderModels;
use app\models\CartModels;


class UserController extends InitController
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
                        'actions' => ['login', 'registration'],
                        'roles' => [UserOperations::RoleGuest],
                        'matchCallback' => function () {
                            $this->redirect('/user/profile');
                        }
                    ],
                    [
                        'actions' => ['profile', 'users'],
                        'roles' => [UserOperations::RoleUser, UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/user/login');
                        }
                    ],
                    [
                        'actions' => ['add', 'edit'],
                        'roles' => [UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/user/login');
                        }
                    ]
                ]
            ]
        ];
    }

    public function actionLogout()
    {
        if (isset($_SESSION['user']['id'])) {
            unset($_SESSION['user']);
        }
        $params = require 'app/config/params.php';
        $this->redirect('/' . $params['defaultController'] . '/' . $params['defaultAction']);
    }

    /**
     * Вывод страницы авторизации
     */
    public function actionLogin()
    {
        $this->view->title = 'Авторизация';
        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_login_form'])) {
            $login = !empty($_POST['login']) ? $_POST['login'] : null;
            $password = !empty($_POST['password']) ? $_POST['password'] : null;
            $userModel = new UsersModel();
            $result_auth = $userModel->authByLogin($login, $password);
            if ($result_auth['result']) {
                $this->redirect('/user/profile');
            } else {
                $error_message = $result_auth['error_message'];
            }
        };
        $this->render('login', [
            'error_message' => $error_message
        ]);
    }

    /**
     * Вывод страницы регистрации
     */
    public function actionRegistration()
    {
        $this->view->title = 'Регистрация';
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_registration_form'])) {
            $username = !empty($_POST['username']) ? $_POST['username'] : null;
            $login = !empty($_POST['login']) ? $_POST['login'] : null;
            $password = !empty($_POST['password']) ? $_POST['password'] : null;
            $confirm_password = !empty($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
            if (empty($username)) {
                $error_message = 'Введите Ваше имя!';
            } elseif (empty($login)) {
                $error_message = 'Введите Ваш логин!';
            } elseif (empty($password)) {
                $error_message = 'Введите пароль!';
            } elseif (empty($confirm_password)) {
                $error_message = 'Введите повторный пароль!';
            } elseif ($password !== $confirm_password) {
                $error_message = 'Пароли не совпадают!';
            }
            if (empty($error_message)) {
                $userModel = new UsersModel();
                $user_id = $userModel->addNewUser($username, $login, $password);

                if (!empty($user_id)) {
                    $this->redirect('/user/login');
                }
            }
        }
        $this->render('registration', [
            'error_message' => $error_message
        ]);
    }


    /**
     * Вывод страницы "Мой профиль"
     */
    public function actionProfile()
    {
        $this->view->title = 'Мой профиль';
        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_change_password_form'])) {
            $current_password = !empty($_POST['current_password']) ? $_POST['current_password'] : null;
            $new_password = !empty($_POST['new_password']) ? $_POST['new_password'] : null;
            $confirm_new_password = !empty($_POST['confirm_new_password']) ? $_POST['confirm_new_password'] : null;
            $userModel = new UsersModel();
            $result_auth = $userModel->changePasswordByCurrentPassword($current_password, $new_password, $confirm_new_password);
            if ($result_auth['result']) {
                $this->redirect('/user/profile');
            } else {
                $error_message = $result_auth['error_message'];
            }
        }

        $this->render('profile', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message
        ]);
    }

    /**
     * Вывод страницы "Пользователи"
     *
     *  @var array $users - список пользователей
     */
    public function actionUsers()
    {
        $this->view->title = 'Пользователи';

        $userModel = new UsersModel();
        $users = $userModel->getListUsers();

        $this->render('list', [
            'sidebar' => UserOperations::getMenuLinks(),
            'role' => UserOperations::getRoleUser(),
            'users' => $users
        ]);
    }

    /**
     * Вывод страницы "Добавление пользователя"
     */
    public function actionAdd()
    {
        $this->view->title = 'Добавление пользователя';
        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_user_add_form'])) {
            $username = !empty($_POST['username']) ? $_POST['username'] : null;
            $login = !empty($_POST['login']) ? $_POST['login'] : null;
            $password = !empty($_POST['password']) ? $_POST['password'] : null;
            $confirm_password = !empty($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
            if (empty($username)) {
                $error_message = 'Введите имя!';
            } elseif (empty($login)) {
                $error_message = 'Введите логин!';
            } elseif (empty($password)) {
                $error_message = 'Введите пароль!';
            } elseif (empty($confirm_password)) {
                $error_message = 'Введите повторный пароль!';
            } elseif ($password !== $confirm_password) {
                $error_message = 'Пароли не совпадают!';
            }

            $userModel = new UsersModel();
            $user_id = $userModel->addUser($username, $login, $password);
            if (!empty($user_id['error_message'])) $error_message = 'Такой пользователь есть!';

            if (empty($error_message) && !empty($user_id)) {
                $this->redirect('/user/users');
            }
        }

        $this->render('add', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message
        ]);
    }

    /**
     * Вывод страницы "Редактирования пользователя"
     *
     * @var integer $user_id - id выбранного пользователя
     * @var array $user - данные о пользователе
     */
    public function actionEdit()
    {
        $this->view->title = 'Редактирования пользователя';
        $user_id = !empty($_GET['user_id']) ? $_GET['user_id'] : null;
        $user = null;
        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_user_edit_form'])) {
            $user_data = !empty($_POST['user']) ? $_POST['user'] : null;

            if (!empty($user_data)) {
                $userModel = new UsersModel();
                $result_edit = $userModel->edit($user_id, $user_data);

                if ($result_edit['result']) {
                    $this->redirect('/user/users');
                } else {
                    $error_message = $result_edit['error_message'];
                }
            }
        }

        if (!empty($user_id)) {
            $userModel = new UsersModel();
            $user = $userModel->getUserById($user_id);

            if (empty($user)) {
                $error_message = 'Пользователь не найден!';
            }
        } else {
            $error_message = 'Отсутствует идентификатор записи!';
        }

        $this->render('edit', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'user' => $user
        ]);
    }

    /**
     * Вывод страницы "Удаление пользователя"
     *
     * @var integer $user_id - id выбранного пользователя
     * @var array $user - данные о пользователе
     */
    public function actionDelete()
    {
        $this->view->title = 'Удаление пользователя';
        $user_id = !empty($_GET['user_id']) ? $_GET['user_id'] : null;
        $user = null;
        $error_message = '';

        if (!empty($user_id)) {
            $userModel = new UsersModel();
            $user = $userModel->getUserById($user_id);

            if (!empty($user)) {
                $result_delete = $userModel->deleteById($user_id);
                if ($result_delete['result']) {
                    $this->redirect('/user/users');
                } else {
                    $error_message = $result_delete['error_message'];
                }
            } else {
                $error_message = 'Пользователь не найден!';
            }
        } else {
            $error_message = 'Отсутствует идентификатор записи!';
        }

        $this->render('delete', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'user' => $user
        ]);
    }

    /**
     * Вывод страницы 'Просмотр заказа' покупки пользователя
     *
     * @var array $orders - заказы пользователя
     * @var array $productsQuantity - массив с идентификаторами и количеством товаров
     * @var array $productsIds - массив c идентификаторами товаров
     * @var array $products - список товаров в заказе
     */
    public function actionPurchase()
    {
        $this->view->title = 'Просмотр заказа';
        //$order_id = !empty($_GET['order_id']) ? $_GET['order_id'] : null;
        $orders = null;
        $error_message = '';

        if (!empty($_SESSION['user']['id'])) {
            $adminOrderModel = new AdminOrderModels();
            $orders = $adminOrderModel->getPurchaseById($_SESSION['user']['id']);

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

        $this->render('listPurchases', [
            'sidebar' => UserOperations::getMenuLinks(),
            'orders' => $orders,
            'productsQuantity' => $productsQuantity,
            'products' => $products
        ]);
    }
}
