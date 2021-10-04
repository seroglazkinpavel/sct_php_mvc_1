<?php

use app\core\User;
use app\lib\Point;
use app\lib\Circle;

ini_set('display_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function($class){
    $path = str_replace('\\', '/', $class. '.php');
    if(file_exists($path)) {
        require $path;
    }
});
$user =new User();
$point =new Point();
$circle = new Circle();

