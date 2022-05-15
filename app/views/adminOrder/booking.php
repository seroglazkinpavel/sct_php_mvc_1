<?php

/** @var array $orders - Заказы */
/** @var array $products - Продукты */
/**@var array $productsQuantity */

?>
<div class="order">
    <div class="cabinet_sidebar">
        <?php if (!empty($sidebar)) : ?>
            <div class="menu_box">
                <ul>
                    <?php foreach ($sidebar as $link): ?>
                        <li>
                            <a class="menuLink" href="<?= $link['link'] ?>"><?= $link['title'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <div class="productOrder">
        <h2 class="titleTop">Управление заказами</h2>
        <h3 class="titleOrder">Информация о заказе</h3>
        <table class="userPanelTable">
            <tr>
                <th>Номер заказа</th>
                <th>Имя клиента</th>
                <th>Телефон клиента</th>
                <th>Почта</th>
                <th>ID пользователя</th>
                <th>Дата заказа</th>
                <!--<th>Статус заказа</th>-->
            </tr>
            <tr>
                <td><?= $orders['id']; ?></td>
                <td><?= $orders['user_name']; ?></td>
                <td><?= $orders['user_phone']; ?></td>
                <td><?= $orders['user_email']; ?></td>
                <?php if (!empty($orders['user_id'])): ?>
                    <td><?= $orders['user_id']; ?></td>
                <?php else : ?>
                    <td><?php echo '---'; ?></td>
                <?php endif; ?>
                <td><?= $orders['date']; ?></td>
                <!--<td></td>-->
            </tr>
        </table>
        <h3 class="titleOrder">Товары в заказе</h3>
        <table class="userPanelTable">
            <tr>
                <th>ID товара</th>
                <th>Артикул товара</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id']; ?></td>
                    <td><?= $product['article']; ?></td>
                    <td><?= $product['title']; ?></td>
                    <td><?= $product['price']; ?></td>
                    <td><?= $productsQuantity[$product['id']]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>