<?php

/** @var array $comings -товары  */

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
		<h2 class="titleTop">Приход товара</h2>
		<a href="/adminComing/addendum" class="productManagementDelete"><i class="fa fa-plus" style="margin-right:10px;"></i>Добавление нового товар</a>
		<h3 class="titleOrder">Список на данный момент товаров</h3>
		<table class="userPanelTable">
			<tr>
				<th>ID товара</th>
				<th>Название товара</th>
				<th>Дата</th>
				<th>Количество</th>
				<th>Пользователь</th>
				<th>Редактировать</th>
				<th>Удалить</th>
			</tr>
			<?php foreach ($comings as $coming): ?>
				<tr>
					<td><?=$coming['id']; ?></td>					
					<td><?=$coming['title']; ?></td>
					<td><?=$coming['date']; ?></td>					
					<td><?=$coming['count']; ?></td>
					<td><?=$coming['user']; ?></td>
				    <td><a href="/adminComing/edit?coming_id=<?=$coming['id']; ?>" title="Редактировать"><i class="fa fa-edit"></i></a></td>
					<td><a href="/adminComing/delete?coming_id=<?=$coming['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>

				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>