<?php

namespace app\models;

use app\core\BaseModel;

class CartModels extends BaseModel
{
    /**
     * Получаем полную информацию о товарах для списка
     *
     * @param array $productsIds
     * @return array $result
     */
    public function getProductsByIds($productsIds)
    {
        $products = array();
        $idsString = implode(',', $productsIds);
        $products = $this->select("SELECT * FROM `product` WHERE status='1' AND id IN ($idsString)");
        if (!empty($products)) {
            $result = $products;
        }
        return $result;
    }

    /**
     * Сохраняем заказ БД
     *
     * @param string $userName
     * @param string $userPhone
     * @param string $userEmail
     * @param string $userId
     * @param array $productsInCart
     * @return array $result
     */
    public function save($userName, $userPhone, $userEmail, $userId, $productsInCart)
    {
        $result = false;
        $productsInCart = json_encode($productsInCart);

        $products = $this->insert(
            'INSERT INTO `product_order` (`user_name`, `user_phone`, `user_email`, `user_id`, `date`, `products_in_cart`)
                                VALUES (:user_name, :user_phone, :user_email, :user_id, NOW(), :products_in_cart)',
            [
                'user_name' => $userName,
                'user_phone' => $userPhone,
                'user_email' => $userEmail,
                'user_id' => $userId,
                'products_in_cart' => $productsInCart
            ]
        );
        if (!empty($products)) {
            $result = $products;
        }
        return $result;
    }
}