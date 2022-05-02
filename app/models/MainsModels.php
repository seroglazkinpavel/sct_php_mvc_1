<?php


namespace app\models;

use app\core\BaseModel;

class MainsModels extends BaseModel
{
    // Метод по выводу брендов
    public function getListBrands()
    {
        $result = null;
        $brands = $this->select("SELECT * FROM `brand`");
        if (!empty($brands)) {
            $result = $brands;
        }
        return $result;
    }

    // Метод по выводу новинок
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