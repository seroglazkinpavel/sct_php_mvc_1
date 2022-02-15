<?php


namespace app\models;

use app\core\BaseModel;

class NewsModels extends BaseModel
{
    // Метод добавление новостей
    public function add($news_data)
    {
        $result = false;
        $error_message = '';

        if (empty($news_data['title'])) {
            $error_message = 'Введите наименование!';
        } elseif (empty($news_data['short_description'])) {
            $error_message = 'Введите краткое описание!';
        } elseif (empty($news_data['description'])) {
            $error_message = 'Введите описание!';
        }

        if (empty($error_message)) {
            $news_id = $this->insert(
                'INSERT INTO `news` (`title`, `short_description`, `description`, `date_create`, `user_id`)
                                VALUES (:title, :short_description, :description, NOW(), :user_id)',
                [
                    'title' => $news_data['title'],
                    'short_description' => $news_data['short_description'],
                    'description' => $news_data['description'],
                    'user_id' => $_SESSION['user']['id'],
                ]
            );

            $result = $news_data;
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function edit($news_id, $news_data)
    {
        $result = false;
        $error_message = '';

        if (empty($news_id)) {
            $error_message = 'Отсутствует индентификатор записи!';
        } elseif (empty($news_data['title'])) {
            $error_message = 'Введите наименование!';
        } elseif (empty($news_data['short_description'])) {
            $error_message = 'Введите краткое описание!';
        } elseif (empty($news_data['description'])) {
            $error_message = 'Введите описание!';
        }

        if (empty($error_message)) {
            $news_id = $this->update(
                'UPDATE `news` SET `title`=:title, `short_description`=:short_description, `description`=:description WHERE `id`=:id',

                [
                    'title' => $news_data['title'],
                    'short_description' => $news_data['short_description'],
                    'description' => $news_data['description'],
                    'id' => $news_id,
                ]
            );

            $result = $news_data;
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function deleteById($news_id)
    {
        $result = false;
        $error_message = '';

        if (empty($news_id)) {
            $error_message = 'Отсутствует индентификатор записи!';
        }

        if (empty($error_message)) {
            $news_id = $this->delete(
                'DELETE FROM `news` WHERE `id`=:id',

                [
                    'id' => $news_id,
                ]
            );

            $result = $news_id;
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    // Метод по выводу всех новостей
    public function getListNews()
    {
        $result = null;
        $news = $this->select("SELECT * FROM `news`");
        if (!empty($news)) {
            $result = $news;
        }
        return $result;
    }

    public function getNewsById($news_id)
    {
        $result = null;
        $news = $this->select(
            "SELECT * FROM `news` WHERE `id`=:id",
            [
                'id' => $news_id
            ]
        );
        if (!empty($news[0])) {
            $result = $news[0];
        }
        return $result;
    }
}