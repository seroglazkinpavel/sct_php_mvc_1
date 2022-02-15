<?php
/** @var array $sidebar - Меню */
/** @var array $news - Список новостей */
/** @var array $role - Роль пользователя */

use app\lib\UserOperations;
?>

<div class="page">
    <div class="container">
        <div class="cabinet_wrapper">
            <div class="cabinet_sidebar">
                <?php if (!empty($sidebar)) :?>
                    <div class="menu_box">
                        <ul>
                            <?php foreach($sidebar as $link) :?>
                                <li>
                                    <a href="<?= $link['link']?>"><?= $link['title']?></a>
                                </li>
                            <?php endforeach?>
                        </ul>
                    </div>
                <?php endif;?>
            </div>
            <div class="cabinet_content">
                <div class="page-content-inner">
                    <h2>Новости</h2>
                        <div class="news-block">
                            <div class="Links-box text-right">
                                <a href="/news/add">Добавить</a>
                            </div>

                            <?php if (!empty($news)) : ?>
                                <div class="news-list">
                                    <?php foreach ($news as $item) : ?>
                                        <div class="news-item">
                                            <h3>
                                                <?= $item['title'] ?><span> от <?= date('d.m.Y H:i:s', strtotime($item['date_create'])) ?></span>
                                                <?php if ($role === \app\lib\UserOperations::RoleAdmin) : ?>
                                                    (<a href="/news/edit?news_id=<?= $item['id'] ?>">редактировать</a> <a
                                                            href="/news/delete?news_id=<?= $item['id'] ?>">удалить</a>)
                                                <?php endif; ?>
                                            </h3>
                                            <div class="news-short_description"><?= $item['short_description'] ?></div>
                                            <div class="news-description"><?= $item['description'] ?></div>
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
