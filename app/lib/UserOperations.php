<?php


namespace app\lib;


class UserOperations
{
    const RoleGuest = 'guest';
    const RoleAdmin = 'admin';
    const RoleUser = 'user';

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

    // Создает ссылки для меню в виде массива
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
	
	public static function addProduct($id)
	{
		$id = intval($id);
				
		$productsInCart = array(); // Пустой массив для товаров в карзине
		
		// Если в корзине уже есть товары (они хранятся в сессии)
		if (isset($_SESSION['products'])) {			
			$productsInCart = $_SESSION['products']; // То заполним наш массив товароми
		}
		
		// Если товар есть в карзине, но был добавлен еще раз, увеличим количество
		if (array_key_exists($id, $productsInCart)) {
			$productsInCart[$id] ++;
		} else {
			
			$productsInCart[$id] =1; // Добавляем новый товар в корзину
		}
		
		$_SESSION['products'] = $productsInCart;
		
	}
	
	// Удаляем товар с указанным id из карзины
	public static function deleteProduct($id)
	{
		$id = intval($id);
			
		$productsInCart = self::getProducts(); // Получаем массив с идентификатором и количеством товаров в карзине
		
		unset ($productsInCart["$id"]); // Удаляем из массива элемент с указанным id

		$_SESSION['products'] = $productsInCart; // Записываем массив товаров с удаленным элементом в сессии
		
	}
	
	// Получение массива продуктов
	public static function getProducts()
	{
		if (isset($_SESSION['products'])) {
			return $_SESSION['products'];
		} 
		return false;
	}
	
	// Подсчет количество товаров в корзине (в сессии)
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
	
	// Очищаем карзину
	public static function clear()
	{
		if (isset($_SESSION['products'])) {
			unset($_SESSION['products']);
		}
	}
}