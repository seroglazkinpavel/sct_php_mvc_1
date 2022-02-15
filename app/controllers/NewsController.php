<?php


namespace app\controllers;


use app\core\InitController;
use app\lib\UserOperations;
use app\models\NewsModels;

class NewsController extends InitController
{
    public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['list'],
                        'roles' => [UserOperations::RoleUser, UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/user/login');
                        }
                    ],
                    [
                        'actions' => ['add', 'edit'],
                        'roles' => [UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                        $this->redirect('/news/list');
                        }
                    ]
                ]
            ]
        ];
    }

    public function actionList()
    {
        $this->view->title = 'Новости';

        $userModel = new NewsModels();
        $news =$userModel->getListNews();

        $this->render('list', [
            'sidebar' => UserOperations::getMenuLinks(),
            'role' => UserOperations::getRoleUser(),
            'news' => $news
        ]);
    }

    public function actionAdd()
    {
        $this->view->title = 'Добавление новости';
        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_news_add_form'])) {
            $news_data = !empty($_POST['news']) ? $_POST['news'] : null;

            if (!empty($news_data)) {
                $userModel = new NewsModels();
                $result_add = $userModel->add($news_data);
                if ($result_add['result']) {
                    $this->redirect('/news/list');
                } else {
                    $error_message = $result_add['error_message'];
                }
            }
        }

        $this->render('add', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message
        ]);
    }

    public function actionEdit()
    {
        $this->view->title = 'Редактирование новости';
        $news_id = !empty($_GET['news_id']) ? $_GET['news_id'] : null;
        $news = null;
        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_news_edit_form'])) {
            $news_data = !empty($_POST['news']) ? $_POST['news'] : null;

            if (!empty($news_data)) {
                $newsModel = new NewsModels();
                $result_edit = $newsModel->edit($news_id, $news_data);
                if ($result_edit['result']) {
                    $this->redirect('/news/list');
                } else {
                    $error_message =$result_edit['error_message'];
                }
            }
        }

        if (!empty($news_id)) {
            $newsModel =new NewsModels();
            $news =  $newsModel->getNewsById($news_id);
            if (empty($news)) {
                $error_message = 'Новость не найдена!';
            }
        } else {
            $error_message = 'Отсутствует индентификатор записи!';
        }

        $this->render('edit', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'news' => $news
        ]);
    }

    public function actionDelete()
    {
        $this->view->title = 'Удаление новости';
        $news_id = !empty($_GET['news_id']) ? $_GET['news_id'] : null;
        $news = null;
        $error_message = '';
		
		
        if (!empty($news_id)) {
            $newsModel =new NewsModels();
            $news =  $newsModel->getNewsById($news_id);
            if (empty($news)) {
                $error_message = 'Новость не найдена!';
            }
        } else {
            $error_message = 'Отсутствует индентификатор записи!';
        }
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_news_delete_form'])) {
            $result_delete = $newsModel->deleteById($news_id);

            if ($result_delete['result']) {
                $this->redirect('/news/list');
            } else {
                $error_message =$result_delete['error_message'];
            }
		}
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_news_notDelete_form'])) {
            $this->redirect('/news/list');
		}
		
        $this->render('delete', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'news' => $news
        ]);
    }
}