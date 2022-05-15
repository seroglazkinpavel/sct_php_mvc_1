<?php


namespace app\models;

use app\core\BaseModel;

class MainsModels extends BaseModel
{
    /**
     * Вывод брендов
     *
     * @return array $result
     */
    public function getListBrands()
    {
        $result = null;
        $brands = $this->select("SELECT * FROM `brand`");
        if (!empty($brands)) {
            $result = $brands;
        }
        return $result;
    }

    /**
     * Вывод новинок
     *
     * @return array $result
     */
    public function getListHits()
    {
        $result = null;
        $hits = $this->select("SELECT * FROM `product` WHERE hit = '1' AND status = '1' LIMIT 8");
        if (!empty($hits)) {
            $result = $hits;
        }
        return $result;
    }
}