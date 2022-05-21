<?php

namespace app\core;

trait TSingletone
{

    private static $instance;

    /**
     * Метод для создания классического singletone
     *
     * @return object $instance
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

}