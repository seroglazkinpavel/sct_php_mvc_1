<?php


namespace app\core;


class View
{
    public $route;
    public $title;
    public $layout = 'watches';

    /**
     * Вывод конструктора
     *
     * @param array  $route — ['controller', 'action']
     */
    public function __construct($route)
    {
        $this->route = $route;
    }

    /**
     * Вывод вида страницы
     *
     * @param string $view - название вида
     * @param array $params
     * @var string $path_view - путь к виду
     */
    public function render($view, $params = [])
    {
        $path_view = 'app/views/' . $this->route['controller'] . '/' . $view . '.php';
        if (file_exists($path_view)) {
            extract($params, EXTR_OVERWRITE);
            ob_start();
            require $path_view;
            $content = ob_get_clean();
            require 'app/views/layouts/' . $this->layout . '.php';
        } else {
            echo 'Вид не найден.';
        }
    }

    /**
     * Перенаправление на страницу $url
     *
     * @param string $url - адрес
     */
    public function redirect($url)
    {
        header('location:' . $url);
        exit;
    }

    /**
     * Ошибки 403, 404
     *
     * @param string $code
     */
    public static function errorCode($code)
    {
        http_response_code($code);
        $path = 'app/views/errors/' . $code . '.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }
}