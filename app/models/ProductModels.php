<?php


namespace app\models;

use app\core\BaseModel;

class ProductModels extends BaseModel
{
    /**
     * Выборка продукта
     *
     * @var string $alias - алиас
     * @return array $result
     */
    public function getOneProduct()
    {
        $alias = !empty($_GET['alias']) ? $_GET['alias'] : null;
        $result = null;
        $product = $this->select(
            "SELECT * FROM `product` WHERE `alias`=:alias",
            [
                'alias' => $alias
            ]
        );
        if (!empty($product)) {
            $result = $product;
        }
        return $result;
    }

    /**
     * Выборка всех продуктав по возрастанию
     *
     * @return array $result
     */
    public function getProductsListAll()
    {
        $result = null;
        $products = $this->select("SELECT * FROM `product` ORDER BY id ASC");

        if (!empty($products)) {
            $result = $products;
        }
        return $result;
    }

    /**
     * Удаление товара
     *
     * @var integer $product_id id удаляемого товара
     * @return array
     */
    public function deleteById($product_id)
    {
        $result = false;
        $error_message = '';

        if (empty($product_id)) {
            $error_message = 'Отсутствует индентификатор записи!';
        }

        if (empty($error_message)) {
            $product_id = $this->delete(
                'DELETE FROM `product` WHERE `id`=:id',

                [
                    'id' => $product_id,
                ]
            );

            $result = $product_id;
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    /**
     * Редактирование продукта
     *
     * @param integer $product_id - id продукта
     * @param array $product_data - продукт
     * @return array
     */
    public function edit($product_id, $product_data)
    {
        $result = false;
        $error_message = '';

        if (empty($product_id)) {
            $error_message = 'Отсутствует идентификатор пользователя!';
        }

        if (empty($error_message)) {
            $product_id = $this->update(
                'UPDATE `product` SET `title`=:title, `alias`=:alias, `price`=:price, `status`=:status, `depart`=:depart, `article`=:article, `grade`=:grade, `height`=:height WHERE `id`=:id',
                [
                    'title' => $product_data['title'],
                    'alias' => $product_data['alias'],
                    'price' => $product_data['price'],
                    'status' => $product_data['status'],
                    'depart' => $product_data['depart'],
                    'article' => $product_data['article'],
                    'grade' => $product_data['grade'],
                    'height' => $product_data['height'],
                    'id' => $product_id
                ]
            );
            $result = $product_id;
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    /**
     * Выборка продукта по id
     *
     * @param integer $product_id - id продукта
     * @return array $result
     */
    public function getProductById($product_id)
    {
        $result = null;
        $product = $this->select(
            "SELECT * FROM `product` WHERE `id`=:id",
            [
                'id' => $product_id
            ]
        );
        if (!empty($product[0])) {
            $result = $product[0];
        }
        return $result;
    }

    /**
     * Добавления товара
     *
     * @param array $options - товар
     * @return array
     */
    public function getProductCreate($options)
    {
        $result = false;
        $errors = '';

        if (empty($options['category_id'])) {
            $errors = 'Введите категорию товара!';
        } elseif (empty($options['title'])) {
            $errors = 'Введите название товара!';
        } elseif (empty($options['alias'])) {
            $errors = 'Введите алиас!';
        } elseif (empty($options['price'])) {
            $errors = 'Введите стоимость!';
        } elseif (empty($options['status'])) {
            $errors = 'Введите статус!';
        } elseif (empty($options['depart'])) {
            $errors = 'Введите как отправляются!';
        } elseif (empty($options['article'])) {
            $errors = 'Введите артикул!';
        } elseif (empty($options['grade'])) {
            $errors = 'Введите класс!';
        } elseif (empty($options['height'])) {
            $errors = 'Введите высоту!';
        }

        if (empty($errors)) {
            $id = $this->insert(
                'INSERT INTO `product` (`category_id`, `title`, `alias`, `price`, `status`, `depart`, `article`, `grade`, `height`, `img`)
									VALUES (:category_id, :title, :alias, :price, :status, :depart, :article, :grade, :height, :img)',
                [
                    'category_id' => $options['category_id'],
                    'title' => $options['title'],
                    'alias' => $options['alias'],
                    'price' => $options['price'],
                    'status' => $options['status'],
                    'depart' => $options['depart'],
                    'article' => $options['article'],
                    'grade' => $options['grade'],
                    'height' => $options['height'],
                    'img' => $options['img']['name'],
                ]
            );
            $result = $id;
        }
        return [
            'result' => $result,
            'errors' => $errors
        ];
    }
}
