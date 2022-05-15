<?php


namespace app\core;

use app\lib\UserOperations;

class Router
{
    protected $params = [];

    /**
     * Сопостовление контроллера и экшена в адресной строке
     *
     * @var string $url - адресная строка
     * @var array $params - ['controller', 'action'] или [] по умолчанию
     * @return bool
     */
    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        if (!empty($url)) {
            if (strpos($url, '?') !== false) {
                $link = explode('?', $url);
                if (!empty($link[0])) {
                    $url = $link[0];
                }
            }
            $params = explode('/', $url);

            if (!empty($params[0]) && !empty($params[1])) {
                $this->params = [
                    'controller' => $params[0],
                    'action' => $params[1]
                ];
                if (!empty($params[0]) && $params[0] === 'category') {
                    $params[1] = 'index';
                    $this->params = [
                        'controller' => 'category',
                        'action' => 'index'
                    ];
                }
            } else {
                return false;
            }
        } else {
            $params = require 'app/config/params.php';
            $this->params = [
                'controller' => $params['defaultController'],
                'action' => $params['defaultAction']
            ];
        }
        return true;
    }

    /**
     * Проверяе имеет ли доступ экшен
     *
     * @param array $behaviors - правило доступа
     * @return bool
     */
    public function checkBehaviors($behaviors)
    {
        if (empty($behaviors['access']['rules'])) {
            return true;
        }
        foreach ($behaviors['access']['rules'] as $rule) {
            if (in_array($this->params['action'], $rule['actions'])) {
                if (in_array(UserOperations::getRoleUser(), $rule['roles'])) {
                    return true;
                } else {
                    if (isset($rule['matchCallback'])) {
                        call_user_func($rule['matchCallback']);
                    } else {
                        View::errorCode(403);
                    }
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Метод который будет запускать class Router
     *
     * @var string $path_controller - путь для контроллера
     * @var string $action - название метода  данного контроллера
     * @var array $behaviors - правило доступа
     */
    public function run()
    {
        if ($this->match()) {
            $path_controller = 'app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($path_controller)) {
                $action = 'action' . ucfirst($this->params['action']);
                if (method_exists($path_controller, $action)) {
                    $controller = new $path_controller($this->params);
                    $behaviors = $controller->behaviors();
                    if ($this->checkBehaviors($behaviors)) {
                        $controller->$action();
                    }
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}
