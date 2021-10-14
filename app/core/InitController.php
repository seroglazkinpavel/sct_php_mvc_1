<?php


namespace app\core;


class InitController
{
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
    }
}