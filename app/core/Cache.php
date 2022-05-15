<?php

namespace app\core;

class Cache
{
    use TSingletone;

    /**
     * Метод с помощью которого мы запишем что-то в кэш
     *
     * @param string $key - ключ массива кэша
     * @param array $data - записанные данные в кэш
     * @param int $seconds - время кэширования
     * @return bool
     */
    public function set($key, $data, $seconds = 3600)
    {
        if ($seconds) {
            $content['data'] = $data;
            $content['end_time'] = time() + $seconds;
            if (file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/tmp/cache/' . md5($key) . '.txt', serialize($content))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Метод для получения что-то из кэша
     *
     * @param string $key - ключ массива кэша
     * @return bool
     */
    public function get($key)
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/tmp/cache/' . md5($key) . '.txt';
        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time']) {
                return $content['data'];
            }
            unlink($file);
        }
        return false;
    }

    /**
     * Метод для удаления кэш
     *
     * @param string $key - ключ массива кэша
     */
    public function delete($key)
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/tmp/cache/' . md5($key) . '.txt' . md5($key) . '.txt';
        if (file_exists($file)) {
            unlink($file);
        }
    }

}