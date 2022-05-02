<?php

namespace app\widgets\menu;

use app\core\Cache;
use app\core\InitController;
use app\models\CategoryModels;

class Menu
{

    protected $data;                     // данные
    protected $tree;                     // массив дерева, который будем строить из данных
    protected $menuHtml;                 // готовый код нашего меню
    protected $tpl;                      // свойство в котором будем хранить шаблон, который необходимо использовать для менюшки
    protected $container = 'ul';         // контейнер для нашего меню (по умолчанию он у нас классический)
    protected $class = 'menuUl';
    protected $table = 'category';       // таблица в БД
    protected $cache = 3600;             // на какое время мы хотим кэшировать данные
    protected $cacheKey = 'ishop_menu';  // это ключ под которым будут сохранятся данные кэша
    protected $attrs = [];               // массив атрибутов дополнительных для нашей менюшки
    protected $prepend = '';             // для админки

    public function __construct($options = [])
    {
        $this->tpl = $_SERVER['DOCUMENT_ROOT'] . '/app/widgets/menu/menu_tpl/menu.php'; //  __DIR__ 
        $this->getOptions($options);
        $this->run();
    }

    // Метод для получение опций
    protected function getOptions($options)
    {
        foreach ($options as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }

    // формирует менюшку
    protected function run()
    {
        $cache = Cache::instance();
        $this->menuHtml = $cache->get($this->cacheKey);
        if (!$this->menuHtml) {
            $this->data = InitController::cacheCategory('cats');  // берем из кэша категории по ключу 'cats' 			
            if (!$this->data) {
                $categoryModel = new CategoryModels();
                $this->data = $cats = $categoryModel->getCategoryAll();
            }
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            if ($this->cache) {
                $cache->set($this->cacheKey, $this->menuHtml, $this->cache);
            }
        }
        $this->output();
    }

    protected function output()
    {
        $attrs = '';
        if (!empty($this->attrs)) {
            foreach ($this->attrs as $k => $v) {
                $attrs .= " $k='$v' ";
            }
        }
        echo "<{$this->container} class='{$this->class}' $attrs>";
        echo $this->prepend;
        echo $this->menuHtml;
        echo "</{$this->container}>";
    }

    // Метод получающий дерево
    protected function getTree()
    {
        $tree = [];
        $data = $this->data;
        foreach ($data as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                $data[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    // Получение html кода
    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $category) {
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    // Возьмем какую-либо категорию и по шаблону сформируем из нее кусочек HTML кода
    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();

        require $this->tpl;
        return ob_get_clean();
    }
}