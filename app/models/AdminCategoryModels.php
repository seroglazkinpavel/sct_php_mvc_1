<?php


namespace app\models;

use app\core\BaseModel;


class AdminCategoryModels extends BaseModel
{
    /**
     * Добавление новой категории
     *
     * @param array $options
     * @return array
     */
    public function getProductAddendum($options)
    {
        $result = false;
        $errors = '';

        if (empty($options['title'])) {
            $errors = 'Введите название категории!';
        } elseif (empty($options['alias'])) {
            $errors = 'Введите alias!';
        }
        if (empty($errors)) {
            $id = $this->insert(
                'INSERT INTO `category` (`title`, `alias`)
									VALUES (:title, :alias)',
                [
                    'title' => $options['title'],
                    'alias' => $options['alias'],
                ]
            );
            $result = $id;
        }
        return [
            'result' => $result,
            'errors' => $errors
        ];
    }

    /**
     * Выбор категории по id
     *
     * @param integer $category_id - id товара
     * @return array $result
     */
    public function getProductById($category_id)
    {
        $result = null;
        $category = $this->select(
            "SELECT * FROM `category` WHERE `category_id`=:category_id",
            [
                'category_id' => $category_id
            ]
        );
        if (!empty($category[0])) {
            $result = $category[0];
        }
        return $result;
    }

    /**
     * Удаление категории
     *
     * @param integer $category_id - id категории
     * @return array
     */
    public function deleteById($category_id)
    {
        $result = false;
        $error_message = '';

        if (empty($category_id)) {
            $error_message = 'Отсутствует индентификатор записи!';
        }

        if (empty($error_message)) {
            $category_id = $this->delete(
                'DELETE FROM `category` WHERE `category_id`=:category_id',

                [
                    'category_id' => $category_id,
                ]
            );

            $result = $category_id;
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    /**
     * Редактирование категории
     *
     * @param integer $category_id - id категории
     * @param array $category_data
     * @return array
     */
    public function edit($category_id, $category_data)
    {
        $result = false;
        $error_message = '';

        if (empty($category_id)) {
            $error_message = 'Отсутствует идентификатор категории!';
        } elseif (empty($category_data['title'])) {
            $error_message = 'Введите название категории!';
        } elseif (empty($category_data['alias'])) {
            $error_message = 'Введите алиас!';
        }
        if (empty($error_message)) {
            $category_id = $this->update(
                'UPDATE `category` SET `title`=:title, `alias`=:alias WHERE `category_id`=:category_id',
                [
                    'title' => $category_data['title'],
                    'alias' => $category_data['alias'],
                    'category_id' => $category_id
                ]
            );
            $result = $category_id;
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }
}
