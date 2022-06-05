<?php

/** @var array $categoryList -товары  */

?>
<div class="userPanel">
    <div class="cabinet_sidebar">
        <?php if (!empty($sidebar)) :?>
            <div class="menu_box">
                <ul>
                    <?php foreach($sidebar as $link): ?>
                        <li>
                            <a class="menuLink" href="<?= $link['link']?>"><?= $link['title']?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif;?>
    </div>
    <div class="productManagement">
        <h2 class="titleTop">Управление категориями</h2>
        <a href="/adminCategory/addendum" class="productManagementDelete"><i class="fa fa-plus"></i>Добавить категорию</a>
        <h3 class="titleOrder">Список категорий</h3>
        <table class="userPanelTable">
            <tr>
                <th>ID категории</th>
                <th>Название категории</th>
                <th>Редактировать</th>
                <th>Удалить</th>
            </tr>
            <?php foreach ($categoryList as $category): ?>
                <tr>
                    <td><?=$category['category_id']; ?></td>
                    <td><?=$category['title']; ?></td>
                    <td><a href="/adminCategory/edit?category_id=<?=$category['category_id']; ?>" title="Редактировать"><i class="fa fa-edit"></i></a></td>
                    <td><a href="/adminCategory/delete?category_id=<?=$category['category_id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
