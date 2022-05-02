<?php

namespace app\models;

use app\core\BaseModel;

class AdminComingModels extends BaseModel
{
	public function getComing()
	{
		$result = false;
		$coming = $this->select("SELECT * FROM `coming` ");
		if (!empty($coming)) {
			$result = $coming;
		}
		return $result;
	}
	
	public function getProductAddendum($options)
	{
		$result = false;
        $errors = '';
		
		if (empty($options['title'])) {
           $errors = 'Введите название товара!';
        } elseif (empty($options['user'])) {
           $errors = 'Введите пользователя!';
        } elseif (empty($options['count'])) {
           $errors = 'Введите количество товара!';
        }
		
		if (empty($errors)) {
			$id = $this->insert(
				'INSERT INTO `coming` (`title`, `date`, `user`, `count`)
									VALUES (:title, NOW(), :user, :count)',
				[
				'title' => $options['title'],
				'user' => $options['user'],
				'count' => $options['count'],  
				]
			);			
			$result = $id;
        }	
        return [
            'result' => $result,
            'errors' => $errors
        ];
	}
	
	public function deleteById($coming_id)
    {
        $result = false;
        $error_message = '';

        if (empty($coming_id)) {
            $error_message = 'Отсутствует индентификатор записи!';
        }

        if (empty($error_message)) {
            $coming_id = $this->delete(
                'DELETE FROM `coming` WHERE `id`=:id',

                [
                    'id' => $coming_id,
                ]
            );

            $result = $coming_id;
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }
	
	public function getProductById($coming_id)
    {
        $result = null;
        $coming = $this->select(
            "SELECT * FROM `coming` WHERE `id`=:id",
            [
                'id' => $coming_id
            ]
        );
        if (!empty($coming[0])) {
            $result = $coming[0];
        }
		return $result;
    }
	
	public function edit($coming_id, $coming_data)
    {
        $result = false;
        $error_message = '';

        if (empty($coming_id)) {
            $error_message = 'Отсутствует идентификатор пользователя!';
        } elseif (empty($coming_data['count'])) {
            $error_message = 'Введите количество товаров!';
        }
        if (empty($error_message)) {
            $coming_id = $this->update(
                'UPDATE `coming` SET `title`=:title, `date`=NOW(), `user`=:user, `count`=:count WHERE `id`=:id',
                [
                    'title' => $coming_data['title'],
                    'user' => $coming_data['user'],
					'count' => $coming_data['count'],
                    'id' => $coming_id
                ]
            );
            $result = $coming_id;
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }
	
	public function getComingById($coming_id)
    {
        $result = null;

        $coming = $this->select(
            "SELECT * FROM `coming` WHERE `id`=:id",
            [
                'id' => $coming_id
            ]
        );

        if (!empty($coming[0])) {
            $result = $coming[0];
        }
        return $result;
    }
}