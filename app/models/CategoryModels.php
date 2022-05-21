<?php

namespace app\models;

use app\core\BaseModel;

class CategoryModels extends BaseModel
{
    /**
     * Выборка всех категорий
     *
     * @return array $result
     */
    public function getCategoryAll()
    {
        $result = false;
        $categorys = $this->select("SELECT * FROM `category` ");
        if (!empty($categorys)) {
            $result = $categorys;
        }
        return $result;
    }

    /**
     * Выводу продуктов категорий
     *
     * @param string $alias
     * @param integer $category_id
     * @return array $result
     */
    public function getListProducts($alias)
    {
        $result = null;
        $category_id = $this->select(
            "SELECT category_id FROM `category` WHERE `alias`=:alias",
            [
                'alias' => $alias
            ]
        );

        if (!empty($category_id)) {

            $category_id = (int)implode($category_id[0]);
            $products = $this->select(
                "SELECT * FROM `product` WHERE `category_id`='{$category_id}'"
            );

            if (!empty($products)) {
                $result = $products;
            }
        }
        return $result;
    }

    /**
     * Выбор название категории
     *
     * @param string $alias
     * @return array $result
     */
    public function getTitleCategory($alias)
    {
        $result = null;
        $title = $this->select(
            "SELECT title FROM `category` WHERE `alias`=:alias",
            [
                'alias' => $alias
            ]
        );

        if (!empty($title)) {
            $result = $title;
        }
        return $result;
    }
}
