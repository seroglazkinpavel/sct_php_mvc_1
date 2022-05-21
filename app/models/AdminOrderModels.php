<?php

namespace app\models;

use app\core\BaseModel;

class AdminOrderModels extends BaseModel
{
    /**
     * Управление заказами
     *
     * @return array $result
     */
    public function getOrder()
    {
        $result = false;
        $order = $this->select("SELECT * FROM `product_order` ");
        if (!empty($order)) {
            $result = $order;
        }
        return $result;
    }

    /**
     * Удаление заказа
     *
     * @param integer $order_id - id заказа
     * @return array
     */
    public function deleteById($order_id)
    {
        $result = false;
        $error_message = '';

        if (empty($order_id)) {
            $error_message = 'отсутствует индентификатор записи!';
        }

        if (empty($error_message)) {
            $order_id = $this->delete(
                'DELETE FROM `product_order` WHERE `id`=:id',

                [
                    'id' => $order_id,
                ]
            );

            $result = $order_id;
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    /**
     * Выбор заказа по id
     *
     * @param integer $order_id - id товара
     * @return array $result
     */
    public function getOrderById($order_id)
    {
        $result = null;
        $order = $this->select(
            "SELECT * FROM `product_order` WHERE `id`=:id",
            [
                'id' => $order_id
            ]
        );
        if (!empty($order[0])) {
            $result = $order[0];
        }
        return $result;
    }

    /**
     * Информация о заказе
     *
     * @param integer $order_id - id пользователя заказа
     * @return array $result
     */
    public function getPurchaseById($order_id)
    {
        $result = null;
        $order = $this->select(
            "SELECT * FROM `product_order` WHERE `user_id`=:user_id",
            [
                'user_id' => $order_id
            ]
        );
        if (!empty($order[0])) {
            $result = $order[0];
        }
        return $result;
    }

   /* public function edit($coming_id, $coming_data)
    {
        $result = false;
        $error_message = '';

        if (empty($coming_id)) {
            $error_message = 'отсутствует идентификатор пользовател¤!';
        } elseif (empty($coming_data['count'])) {
            $error_message = '¬ведите количество товаров!';
        }
        if (empty($error_message)) {
            $coming_id = $this->update(
                'UPDATE `coming` SET `title`=:title, `date`=NOW(), `user`=:user, `count`=:count WHERE `id`=:id',
                [
                    'title' => $coming_data['title'],
                    'user' => $coming_data['user'],
                    'count' => $coming_data['count'],
                    'id' => $coming_id
                ]
            );
            $result = $coming_id;
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }*/
}
