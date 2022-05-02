<?php


namespace app\core;

use app\core\Cache;
use app\core\BaseModel;
use app\models\CategoryModels;

abstract class InitController
{
    public $route;
    public $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }

    public function behaviors()
    {
        return [];
    }

    public function render($view, $params = [])
    {
        $this->view->render($view, $params);
    }

    public function redirect($url)
    {
        $this->view->redirect($url);
    }
	
	// кладем в кэш категории
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
