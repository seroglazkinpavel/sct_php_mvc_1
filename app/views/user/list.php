<?php
/** @var array $sidebar - Меню */

/** @var array $users - Список пользователей */


use app\lib\UserOperations;

?>

<div class="page">
    <div class="container">
        <div class="cabinet_wrapper">
            <div class="cabinet_sidebar">
                <?php if (!empty($sidebar)) : ?>
                    <div class="menu_box">
                        <ul>
                            <?php foreach ($sidebar as $link) : ?>
                                <li>
                                    <a href="<?= $link['link'] ?>"><?= $link['title'] ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="cabinet_content">
                <div class="page-content-inner">
                    <h2>Пользователи</h2>
                    <div class="news-block">
                        <div class="Links-box text-right">
                            <a href="/user/add">Добавить</a>
                        </div>

                        <?php if (!empty($users)) : ?>
                            <div class="news-list">
                                <?php foreach ($users as $user) : ?>
                                    <div class="news-item">
                                        <h3>
                                            Имя: <?= $user['username'] ?>
                                            (<a href="/user/edit?user_id=<?= $user['id'] ?>">редактировать</a> <a
                                                    href="/user/delete?user_id=<?= $user['id'] ?>">удалить</a>)
                                        </h3>
                                        <div class="user-login">Логин: <?= $user['login'] ?></div>
                                        <div class="user-is_admin">Является ли
                                            администратором: <?= ($user['is_admin'] === '1' ? 'Да' : 'Нет') ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
