<?php


namespace app\core;

use PDO;
use PDOException;

abstract class BaseModel
{
    protected $db;

    /**
     * Соединение с базой данных с использованием PDO
     *
     * @var array $config - массив конфигурационными настройками
     */
    public function __construct()
    {
        $config = require 'app\config\db.php';
        try {
            $this->db = new PDO(
                'mysql:host=' . $config['hostname'] . ';dbname=' . $config['database'],
                $config['username'],
                $config['password']
            );
        } catch (PDOException $exception) {
            print 'Ошибка:' . $exception->getMessage() . '<br>';
            die();
        }
    }

    /**
     * Общий метод для запросов в базу данных
     *
     * @param string $sql — запрос
     * @param array $params данные из бд
     * @return array $query
     */
    protected function query($sql, $params = [])
    {
        $query = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $query->bindValue(':' . $key, $val);
            }
        }
        $query->execute();
        return $query;
    }

    /**
     * Метод для выборки одной записи из бд
     *
     * @param string $sql — запрос
     * @param array $params данные из бд
     * @return array $result
     */
    protected function selectOne($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Метод для выборки данных из бд
     *
     * @param string $sql — запрос
     * @param array $params данные из бд
     * @return array $result
     */
    protected function select($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Метод для вставки данных в бд
     *
     * @param string $sql — запрос
     * @param array $params данные из бд
     * @return (int)$this->db->lastInsertId()
     */
    protected function insert($sql, $params = [])
    {
        $this->query($sql, $params);
        return (int)$this->db->lastInsertId();
    }

    /**
     * Метод для обнавлении записи
     *
     * @param string $sql — запрос
     * @param array $params данные из бд
     * @return $query->rowCount() - количество измененных записей
     */
    protected function update($sql, $params = [])
    {
        $query = $this->query($sql, $params);
        return $query->rowCount();
    }

    /**
     * Метод для удаление записи
     *
     * @param string $sql — запрос
     * @param array $params данные из бд
     * @return $query->rowCount() - количество измененных записей
     */
    protected function delete($sql, $params = [])
    {
        $query = $this->query($sql, $params);
        return $query->rowCount();
    }
}