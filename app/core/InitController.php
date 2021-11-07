<?php


namespace app\core;


abstract class InitController
{
    public $route;
    public $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }

    public function render($view, $params = [])
    {
        $this->view->render($view, $params);
    }

    public function redirect($url)
    {
        $this->view->redirect($url);
    }

}
