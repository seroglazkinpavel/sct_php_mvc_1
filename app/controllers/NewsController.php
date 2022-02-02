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
                        'actions' => ['add'],
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
}