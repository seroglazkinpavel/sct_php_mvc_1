<?php


namespace app\core;

use app\core\Cache;
use app\core\BaseModel;
use app\models\CategoryModels;

abstract class InitController
{
    public $route;
    public $view;

    /**
     * Вывод конструктора
     *
     * @param array  $route — ['controller', 'action']
     */
    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }

    /**
     * Вывод контроль доступа
     *
     * @return array
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * Вывод вида страницы
     *
     * @param array  $params
     * @param string $view - название вида
     */
    public function render($view, $params = [])
    {
        $this->view->render($view, $params);
    }

    /**
     * Перенаправление на страницу $url
     *
     * @param string $url - адрес
     */
    public function redirect($url)
    {
        $this->view->redirect($url);
    }

    /**
     * сохранение в кэш категории
     *
     * @return array $cats - массив категорий
     */
    public static function cacheCategory(){
        $cache = Cache::instance();
        $cats = $cache->get('cats');
        if(!$cats){
			$categoryModel = new CategoryModels();
            $cats = $categoryModel->getCategoryAll();           
            $cache->set('cats', $cats);
        }		
        return $cats;
    }
}
