<?php


namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\CartModels;

class CartController extends InitController
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
                        'actions' => ['cart', 'add', 'checkout'],
                        'roles' => [UserOperations::RoleGuest, UserOperations::RoleUser, UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/');
                        }
                    ]
                ]
            ]
        ];
    }


    /**
     * Вывод страницы карзины
     *
     * @var array $productsInCart - получение данных из корзины
     * @var array $products - получаем полную информацию о товарах для списка
     * @var float $totalPrice - Получаем общую стоимость товаров
     */
    public function actionCart()
    {
        $this->view->title = 'Корзина';

        $productsInCart = UserOperations::getProducts();
        $products = $this->actionCartProducts();
        $totalPrice = $this->getTotalPrice($products);

        $this->render('cart', [
            'sidebar' => UserOperations::getMenuLinks(),
            'productsInCart' => $productsInCart,
            'products' => $products,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Добавляем товар в корзину
     *
     * @var int $id
     */
    public function actionAdd()
    {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;

        UserOperations::addProduct($id); // Добавляем товар в корзину

        $referrer = $_SERVER['HTTP_REFERER']; // Возвращаем пользователя на страницу
        header("Location: $referrer");

    }
    /**
     * Удаление товара из карзины
     *
     * @var int $id
     */
    public function actionDelete()
    {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;

        UserOperations::deleteProduct($id); // Удаляем товар из корзины

        $referrer = $_SERVER['HTTP_REFERER']; // Возвращаем пользователя на страницу
        header("Location: $referrer");
    }

    /**
     * Вывод страницы оформление заказа
     */
    public function actionCheckout()
    {
        $this->view->title = 'Оформить заказ';

        $errors = '';
        $result = false;  // Статус успешного оформления заказа

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['submit'])) {
            $userName = !empty($_POST['userName']) ? $_POST['userName'] : null;
            $userPhone = !empty($_POST['userPhone']) ? $_POST['userPhone'] : null;
            $userEmail = !empty($_POST['userEmail']) ? $_POST['userEmail'] : null;

            if (empty($userName)) {
                $errors = 'Введите Ваше имя!';
            } elseif (empty($userPhone)) {
                $errors = 'Введите номер телефона!';
            } elseif (empty($userEmail)) {
                $errors = 'Введите email!';
            }

            // Если форма заполнена корректно сохраняем в базе данных
            if ($errors == false) {
                // Собираем информацию о заказе
                $productsIdCart = UserOperations::getProducts();
                $role = UserOperations::getRoleUser();
                if ($role == UserOperations::RoleGuest) {
                    $userId = NULL;
                } else {
                    $userId = $_SESSION['user']['id'];
                }

                // Сохраняем заказ БД
                $productsInCart = UserOperations::getProducts();
                $cartModel = new CartModels();
                $result = $cartModel->save($userName, $userPhone, $userEmail, $userId, $productsInCart);
                $productsInCart = UserOperations::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = $this->actionCartProducts($productsIds);
                $totalPrice = $this->getTotalPrice($products);
                $totalQuantity = UserOperations::countItems();
                if ($result) {
                    // Оповещаем администратора о новом заказе
                    $adminEmail = 'php.start@mail.ru';
                    $message = 'http://digital-mafia.net/admin/orders';
                    $subject = 'Новый заказ';
                    mail($adminEmail, $message, $subject);
                    // Очищаем карзину
                    UserOperations::clear();
                }
            } else {
                // Итоги: общая стоимость, количество товаров
                $productsInCart = UserOperations::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = $this->actionCartProducts($productsIds);
                $totalPrice = $this->getTotalPrice($products);
                $totalQuantity = UserOperations::countItems();
                //$errors = $errors;
            }
        } else {
            $productsInCart = UserOperations::getProducts();  // Получаем даные из карзины
            // проверяем есть ли в корзине товар
            if ($productsInCart == false) {
                header("Location: /");  // отправляем пользователя на главную страницу искать товары
            } else {
                // Итоги: общая стоимость, количество товаров
                $productsInCart = UserOperations::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = $this->actionCartProducts($productsIds);
                $totalPrice = $this->getTotalPrice($products);
                $totalQuantity = UserOperations::countItems();
                //$errors = false;

                $userName = false;
                $userPhone = false;
                $userComment = false;

                //if (UserOperations::RoleGuest) {  // Проверяем авторизован ли пользователь
                // Нет
                // Значения для формы пустые
                //} else {
                // Да, авторизован
                // Получаем информацию о пользователе из БД по id
                //$userId = User::checkLogged();
                //$user = User::getUserById($userId);
                // Подставляем в форму
                //$userName = $user['name'];
                //}
            }
        }
        $this->render('checkout', [
            'sidebar' => UserOperations::getMenuLinks(),
            'result' => $result,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
            'errors' => $errors
        ]);
    }

    /**
     * Получение: товаров из корзины(из сессии); полной информации по товарам
     *
     * @var array $productsInCart - получение данных из корзины
     * @var array $productsIds - получаем массив с идентификаторами в карзине
     * @return array $products - получаем полную информацию о товарах для списка
     */
    public function actionCartProducts()
    {
        $products = '';
        //$productsInCart = false;
        $productsInCart = UserOperations::getProducts();

        if ($productsInCart) {
            $productsIds = array_keys($productsInCart);
            $cartModel = new CartModels();
            $products = $cartModel->getProductsByIds($productsIds);
        }
        return $products;
    }

    /**
     * Получение полной цены
     *
     * @var array $productsInCart - получение данных из корзины
     * @return float $total
     */
    public function getTotalPrice($products)
    {
        $productsInCart = UserOperations::getProducts();

        $total = 0;

        if (!empty($productsInCart)) {
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }
        return $total;
    }
}