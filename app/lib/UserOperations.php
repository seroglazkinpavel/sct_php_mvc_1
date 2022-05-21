<?php


namespace app\lib;


class UserOperations
{
    const RoleGuest = 'guest';
    const RoleAdmin = 'admin';
    const RoleUser = 'user';

    /**
     * Выдает роль пользователя
     *
     * @return  string $result - роль пользователя
     */
    public static function getRoleUser()
    {
        $result = self::RoleGuest;
        if (isset($_SESSION['user']['id']) && $_SESSION['user']['is_admin']) {
            $result = self::RoleAdmin;
        } elseif (isset($_SESSION['user']['id'])) {
            $result = self::RoleUser;
        }
        return $result;
    }

    /**
     * Создает ссылки для меню в виде массива
     *
     * @return array $list
     */
    public static function getMenuLinks()
    {
        $role = self::getRoleUser();
        $list[] = [
            'title' => 'Мой профиль',
            'link' => '/user/profile'
        ];
		if ($role === self::RoleUser) {
			$list[] = [
				'title' => 'Список покупок',
				'link' => '/user/purchase'
			];
		}
		if ($role === self::RoleAdmin) {
			$list[] = [
				'title' => 'Управление товарами',
				'link' => '/adminProduct/index'
			];
		}
		if ($role === self::RoleAdmin) {
			$list[] = [
				'title' => 'Управление категориями',
				'link' => '/adminCategory/index'
			];
		}
		if ($role === self::RoleAdmin) {
			$list[] = [
				'title' => 'Управление заказами',
				'link' => '/adminOrder/index'
			];
		}
		if ($role === self::RoleAdmin) {
			$list[] = [
				'title' => 'Приход товара',
				'link' => '/adminComing/index'
			];
		}
        if ($role === self::RoleAdmin) {
            $list[] = [
                'title' => 'Пользователи',
                'link' => '/user/users'
            ];
        }

        $list[] = [
            'title' => 'Выход',
            'link' => '/user/logout'
        ];

        return $list;
    }

    /**
     * Добавление товара в карзину
     *
     * @param integer $id — id текущего товара
     * @var  array $productsInCart[] - Пустой массив для товаров в карзине по умолчанию
     */
	public static function addProduct($id)
	{
		$id = intval($id);
				
		$productsInCart = array();
		
		/*
		 * Если в корзине уже есть товары (они хранятся в сессии)
		 */
		if (isset($_SESSION['products'])) {			
			$productsInCart = $_SESSION['products']; // То заполним наш массив товароми
		}
		
		/*
		 * Если товар есть в карзине, но был добавлен еще раз, увеличим количество
		 */
		if (array_key_exists($id, $productsInCart)) {
			$productsInCart[$id] ++;
		} else {
			/*
			 * Добавляем новый товар в корзину
			 */
			$productsInCart[$id] = 1;
		}
		
		$_SESSION['products'] = $productsInCart;
		
	}

    /**
     * Удаляем товар с указанным id из карзины
     *
     * @param integer $id — id текущего товара
     * var array $productsInCart - массив с идентификатором и количеством товаров в карзине
     */
	public static function deleteProduct($id)
	{
		$id = intval($id);
			
		$productsInCart = self::getProducts();
		/*
		 * Удаляем из массива элемент с указанным id
		 */
		unset ($productsInCart["$id"]);
        /*
         * Записываем массив товаров с удаленным элементом в сессии
         */
		$_SESSION['products'] = $productsInCart;
		
	}

    /**
     * Получение массива продуктов
     *
     * @return array
     */
	public static function getProducts()
	{
		if (isset($_SESSION['products'])) {
			return $_SESSION['products'];
		} 
		return false;
	}

    /**
     * Подсчет количество товаров в корзине (в сессии)
     *
     * @return integer $count - количество товара в корзине
     */
	public static function countItems()
	{
		if (isset($_SESSION['products'])) {
			$count = 0;
			foreach ($_SESSION['products'] as $id => $quantity) {
				$count = $count + $quantity;
			}
			return $count;
		} else {
			return 0;
		}
	}

    /**
     * Очищаем карзину
     */
	public static function clear()
	{
		if (isset($_SESSION['products'])) {
			unset($_SESSION['products']);
		}
	}
}
