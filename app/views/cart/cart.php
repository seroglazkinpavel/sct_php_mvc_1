<?php

/** @var array $productsInCart - Даные из карзины */
/** @var array $products - Товары */
/** @var float $totalPrice - Общая стримость */

?>
<div class="karzina">
    <h2 class="cartTitle">Корзина</h2>
    <?php if ($productsInCart && $products) : ?>
        <p class="choice">Вы выбрали такие товары:</p>
        <table class="tableCart">
            <tr>
                <th></th>
                <th>Наименование товара</th>
                <th>Цена, руб</th>
                <th>Количество</th>
                <th>Удалить</th>
            </tr>

            <?php foreach ($products as $product): ?>
                <tr>
                    <td><img class="cartImg" src="/app/web/images/<?= $product['img']; ?>"></td>
                    <td>
                        <a href="/product/list?alias=<?= $product['alias']; ?>">
                            <?= $product['title'] ?>
                        </a>
                    </td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $productsInCart[$product['id']]; ?></td>
                    <td><a class="linkRemove" href="/cart/delete?id=<?= $product['id']; ?>"><img class="cartImgRemove"
                                                                                                 src="/app/web/images/removeCart.svg"></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
        <div class="totalCost"><p>Общая стоимость: <?= $totalPrice; ?> руб</p></div>
    <?php else: ?>
        <p class="basketEmpty">Корзина пустая</p>
    <?php endif; ?>
    <?php if ($products) : ?>
        <div class="karzinaZaka">
            <a href="/cart/checkout">
                <img src="/app/web/images/basket.png">
                <span>
					Оформить заказ
				</span>
            </a>
        </div>
    <?php endif; ?>
</div>