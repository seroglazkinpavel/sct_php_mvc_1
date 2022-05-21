<?php

/** @var array $orders - Заазы */

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
        <h3 class="titleOrder">Список заказов</h3>
        <table class="userPanelTable">
            <tr>
                <th>ID товара</th>
                <th>Имя</th>
                <th>Телефон</th>
                <th>Почта</th>
                <th>ID пользователя</th>
                <th>Дата</th>
                <!--<th>Товар в карзине</th>-->
                <th>Просмотр</th>
                <!--<th>Редактирование</th>-->
                <th>Удаление</th>
            </tr>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id']; ?></td>
                    <td><?= $order['user_name']; ?></td>
                    <td><?= $order['user_phone']; ?></td>
                    <td><?= $order['user_email']; ?></td>
                    <td><?= $order['user_id']; ?></td>
                    <td><?= $order['date']; ?></td>
                    <!--<td><?= $order['products_in_cart']; ?></td>-->
                    <td><a href="/adminOrder/booking?order_id=<?= $order['id']; ?>" title="Просмотр"><i
                                    class="fa fa-eye"></i></a></td>
                    <!--<td><a href="/adminOrder/update?order_id=<?= $order['id']; ?>" title="Редактировать"><i class="fa fa-edit"></i></a></td>-->
                    <td><a href="/adminOrder/delete?order_id=<?= $order['id']; ?>" title="Удалить"><i
                                    class="fa fa-times"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>