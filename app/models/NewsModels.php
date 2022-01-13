<?php


namespace app\models;

use app\core\BaseModel;

class NewsModels extends BaseModel
{
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
}