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
		<h2 class="titleTop">Список заказанных пакупок</h2>
		<!--<a href="/" class="productManagementDelete"><i class="fa fa-plus"></i>Добавить товар</a>-->
		<table class="userPanelTable">
			<tr>
				<th>Название товара</th>
				<th>Цена</th>
				<th>Количество</th>
				<!--<th>Редактировать</th>-->
				<!--<th>Удалить</th>-->
			</tr>
			<?php foreach ($products as $product): ?>
				<tr>
					<td><?= $product['title'];?></td>
					<td><?= $product['price'];?></td>				
					<td><?= $productsQuantity[$product['id']];?></td>
					<!--<td><a href="/adminProduct/edit?product_id=<?=$product['id']; ?>" title="Редактировать"><i class="fa fa-edit"></i></a></td>-->
					<!--<td><a href="/adminProduct/delete?product_id=<?=$product['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>-->
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>